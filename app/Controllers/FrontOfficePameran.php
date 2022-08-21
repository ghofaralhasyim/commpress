<?php namespace App\Controllers;

use App\Models\PameranMod;
use App\Models\RegistrationMod;
use App\Models\MemberMod;
use App\Models\SubmissionMod;
use CodeIgniter\Pager\Pager;

class FrontOfficePameran extends BaseController
{

    function __construct()
    {
		if (session()->get('role') != "peserta" && session()->get('role') != "curator") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
    }

    public function Details($slug){
        $pameran = new PameranMod();
        $pameran->select('*');
        $pameran->where('pameran.slug',"$slug");
        $data['pameran'] = $pameran->get()->getFirstRow();

        $regist = new RegistrationMod();
        $regist->select('id_member');
        $regist->where('id_pameran',$data['pameran']->id_pameran);
        $regist->where('id_member',session()->get('id'));
        $data['regist'] = $regist->countAllResults();

        $member = new MemberMod();
        $member->select('*');
        $member->where('id_member',session()->get('id'));
        $data['user'] = $member->get()->getFirstRow();

        $pameran = new PameranMod();
        $pameran->select('*');
        $data['listLomba'] = $pameran->get()->getResult();

		return view('publics/pameran/_slug',$data);
	}

    public function Regist(){
        $member = new MemberMod();
        $regist = new RegistrationMod();

        if (!empty($_POST)) {

            $regist->select('id_member,id_pameran');
            $regist->where('id_member',trim($this->request->getVar('id_member')));
            $regist->where('id_pameran',trim($this->request->getVar('id_pameran')));
            $checkRegist = $regist->countAllResults();
            if($checkRegist > 0){
                return redirect()->back();
            }
            $session = session();
            $validation =  \Config\Services::validation();

            $category_member = trim($this->request->getVar('category_member'));

            if($category_member === 'umum'){
                $validation->setRules([
                    'phone' => ['phone' => 'phone', 'rules' => ['required','numeric'], 'errors' => ['required' => 'No. handphone wajib diisi.']],
                    'line' => ['line' => 'line', 'rules' => 'required', 'errors' => ['required' => 'ID Line wajib diisi.']],
			    ]);
            }else{
                 $validation->setRules([
                    'univ' => ['univ' => 'univ', 'rules' => 'required|min_length[11]', 'errors' => ['required' => 'Asal universitas wajib diisi.']],
                    'phone' => ['phone' => 'phone', 'rules' => ['required','numeric'], 'errors' => ['required' => 'No. handphone wajib diisi.']],
                    'line' => ['line' => 'line', 'rules' => 'required', 'errors' => ['required' => 'ID Line wajib diisi.']],
			    ]);
            }

			$isValid = $validation->withRequest($this->request)->run();

            if($isValid){
                $member->set([
                    'id_line' => trim($this->request->getVar('line')),
                    'univ' => trim($this->request->getVar('univ')),
                    'nim' => trim($this->request->getVar('nim')),
                    'phone' => trim($this->request->getVar('phone'))
                ]);
                $member->where('id_member', preg_replace('/\s+/', '', $this->request->getVar('id_member')));
                $member->update();

                $regist->insert([
                    'id_member' => trim($this->request->getVar('id_member')),
                    'id_pameran' => trim($this->request->getVar('id_pameran')),
                    'id_lomba' => null,
                    'status' => 'confirmed',
                    'payment' => null
                ]);
            }else{
                $session->setFlashdata('univ', $validation->getError('univ'));
				$session->setFlashdata('phone', $validation->getError('phone'));
				$session->setFlashdata('line', $validation->getError('line'));
				return redirect()->back()->withInput();
            }
		}
        return redirect()->back();
    }

     public function Submission($slug){
        $pameran = new PameranMod();
        $pameran->select('*');
        $pameran->where('pameran.slug',"$slug");
        $data['pameran'] = $pameran->get()->getFirstRow();

        $regist = new RegistrationMod();
        $regist->select('*, registration.status as regist_status');
        $regist->join('pameran',"pameran.id_pameran = registration.id_pameran");
        $regist->where('id_member',session()->get('id'));
        $regist->where('registration.id_pameran',$data['pameran']->id_pameran);
        $data['regist'] = $regist->get()->getFirstRow();

        $submit = new SubmissionMod();
        $submit->select('*');
        $submit->where('id_regist',$data['regist']->id_regist);
        $data['submission'] = $submit->get()->getFirstRow();

        $member = new MemberMod();
        $member->select('*');
        $member->where('id_member',session()->get('id'));
        $data['user'] = $member->get()->getFirstRow();

        return view('publics/pameran/submit',$data);
    }

    public function Submit(){
        $submit = new SubmissionMod();
        $regist = new RegistrationMod();

        if (!empty($_POST)) {
            $session = session();
            $validation =  \Config\Services::validation();
            
            if($this->request->getVar('slug') === 'info-grafik'){
                 $validation->setRules([
				'title' => ['title' => 'title', 'rules' => 'required', 'errors' => ['required' => 'Judul karya wajib diisi.']],
                'caption' => ['caption' => 'caption', 'rules' => 'required', 'errors' => ['required' => 'Caption wajib diisi.']],
                'karya' => ['karya' => 'karya', 'rules' => ['uploaded[karya]','is_image[karya,image/jpg,image/jpeg,image/png]'], 
                            'errors' => ['is_image' => 'Format gambar tidak sesuai.','uploaded' => 'Karya wajib disertakan.']
                        ],
                'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['uploaded[thumbnail]','is_image[thumbnail,image/jpg,image/jpeg,image/png]'], 
                            'errors' => ['is_image' => 'Format gambar tidak sesuai.','uploaded' => 'Thumbnail wajib disertakan.']
                        ],
			    ]);
            }elseif(preg_replace('/\s+/', '', $this->request->getVar('type')) === 'image'){
                $validation->setRules([
				'title' => ['title' => 'title', 'rules' => 'required', 'errors' => ['required' => 'Judul karya wajib diisi.']],
                'caption' => ['caption' => 'caption', 'rules' => 'required', 'errors' => ['required' => 'Caption wajib diisi.']],
                'karya' => ['karya' => 'karya', 'rules' => ['uploaded[karya]','is_image[karya,image/jpg,image/jpeg,image/png]'], 
                            'errors' => ['is_image' => 'Format gambar tidak sesuai.','uploaded' => 'Karya wajib disertakan.']
                        ],
			    ]);
            }elseif(preg_replace('/\s+/', '', $this->request->getVar('type')) === 'video'){
                $validation->setRules([
				    'title' => ['title' => 'title', 'rules' => 'required', 'errors' => ['required' => 'Judul karya wajib diisi.']],
                    'caption' => ['caption' => 'caption', 'rules' => 'required', 'errors' => ['required' => 'Caption wajib diisi.']],
                    'url' => ['url' => 'url', 'rules' => 'required', 'errors' => ['required' => 'ID video wajib diisi.']],
                    'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['uploaded[thumbnail]','is_image[thumbnail,image/jpg,image/jpeg,image/png]'], 
                            'errors' => ['is_image' => 'Format gambar tidak sesuai.','uploaded' => 'Thumbnail wajib disertakan.']
                        ],
			    ]);
            }elseif(preg_replace('/\s+/', '', $this->request->getVar('type')) === 'audio'){
                $validation->setRules([
				    'title' => ['title' => 'title', 'rules' => 'required', 'errors' => ['required' => 'Judul karya wajib diisi.']],
                    'caption' => ['caption' => 'caption', 'rules' => 'required', 'errors' => ['required' => 'Caption wajib diisi.']],
                    'karya' => ['karya' => 'karya', 'rules' => ['uploaded[karya]','ext_in[karya,mp3,m4a]'], 
                            'errors' => ['ext_in' => 'Format audio tidak sesuai.','uploaded' => 'Karya wajib disertakan.']
                        ],
                    'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['uploaded[thumbnail]','is_image[thumbnail,image/jpg,image/jpeg,image/png]'], 
                            'errors' => ['is_image' => 'Format gambar tidak sesuai.','uploaded' => 'Thumbnail wajib disertakan.']
                        ],                   
			    ]);
            }else{
                $validation->setRules([
				    'title' => ['title' => 'title', 'rules' => 'required', 'errors' => ['required' => 'Judul karya wajib diisi.']],
                    'caption' => ['caption' => 'caption', 'rules' => 'required', 'errors' => ['required' => 'Caption wajib diisi.']]
			    ]);
            }

            $isValid = $validation->withRequest($this->request)->run();
            if($isValid){
                $karya = $this->request->getFile('karya');
                if(is_file($karya)){
                    $karyaFile = $this->request->getVar('slug').'-'.$karya->getRandomName();
                    $karya->move("uploads/submission/".trim($this->request->getVar('slug')).'/', $karyaFile);
                }else{
                    $karyaFile = null;
                }

                $thumbnail = $this->request->getFile('thumbnail');
                if(is_file($thumbnail)){
                    $thumbnailFile = $this->request->getVar('slug').'-thumbnail-'.$thumbnail->getRandomName();
                    $thumbnail->move("uploads/submission/".trim($this->request->getVar('slug')).'/', $thumbnailFile);
                }else{
                    $thumbnailFile = null;
                }

                $submit->insert([
                    'id_regist' => preg_replace('/\s+/', '', $this->request->getVar('id_regist')),
                    'title' => $this->request->getVar('title'),
                    'caption' => $this->request->getVar('caption'),
                    'url' => $this->request->getVar('url'),
                    'media' => $karyaFile,
                    'thumbnail' => $thumbnailFile
                ]);

                $regist->set('status','submitted');
                $regist->where('id_regist',preg_replace('/\s+/', '', $this->request->getVar('id_regist')));
                $regist->update();
            }else{
                $session->setFlashdata('caption', $validation->getError('caption'));
                $session->setFlashdata('url', $validation->getError('url'));
                $session->setFlashdata('thumbnail', $validation->getError('thumbnail'));
				$session->setFlashdata('karya', $validation->getError('karya'));
				$session->setFlashdata('title', $validation->getError('title'));

				return redirect()->back()->withInput();
            }
        }
        return redirect()->back();
    }
}   