<?php namespace App\Controllers;

use App\Models\LombaMod;
use App\Models\RegistrationMod;
use App\Models\MemberMod;
use App\Models\SubmissionMod;

class FrontOfficeLomba extends BaseController
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

    public function DetailsLomba($slug){
        $lomba = new LombaMod();
        $lomba->select('*');
        $lomba->where('lomba.slug',"$slug");
        $data['lomba'] = $lomba->get()->getFirstRow();

        $regist = new RegistrationMod();
        $regist->select('id_member');
        $regist->where('id_lomba',$data['lomba']->id_lomba);
        $regist->where('id_member',session()->get('id'));
        $data['regist'] = $regist->countAllResults();

        $member = new MemberMod();
        $member->select('*');
        $member->where('id_member',session()->get('id'));
        $data['user'] = $member->get()->getFirstRow();

        $lomba = new LombaMod();
        $lomba->select('*');
        $data['listLomba'] = $lomba->get()->getResult();

		return view('publics/lomba/details',$data);
	}

    public function RegistLomba(){
        $member = new MemberMod();
        $regist = new RegistrationMod();

        if (!empty($_POST)) {

            $regist->select('id_member,id_lomba');
            $regist->where('id_member',trim($this->request->getVar('id_member')));
            $regist->where('id_lomba',trim($this->request->getVar('id_lomba')));
            $checkRegist = $regist->countAllResults();
            if($checkRegist > 0){
                return redirect()->back();
            }

            $session = session();
            $validation =  \Config\Services::validation();

            $member->select('ktm,');
            $data_member = $member->where('id_member',$this->request->getVar('id_member'))->first();
			if($data_member['ktm'] == null){
                $validation->setRules([
                    'univ' => ['univ' => 'univ', 'rules' => 'required|min_length[11]', 'errors' => ['required' => 'Asal universitas wajib diisi.']],
                    'ktm' => ['ktm' => 'ktm', 'rules' => [ 'uploaded[ktm]','is_image[ktm,image/jpg,image/jpeg,image/png]'], 'errors' => ['is_image' => 'Gambar tidak sesuai.','uploaded' => 'KTM wajib disertakan.']],
                    'payment' => ['payment' => 'payment', 'rules' => ['uploaded[payment]','is_image[payment,image/jpg,image/jpeg,image/png]'], 'errors' => ['is_image' => 'Gambar tidak sesuai.']],
                    'phone' => ['phone' => 'phone', 'rules' => ['required','numeric'], 'errors' => ['required' => 'No. handphone wajib diisi.']],
                    'line' => ['line' => 'line', 'rules' => 'required', 'errors' => ['required' => 'ID Line wajib diisi.']],
			    ]);
            }else{
                $validation->setRules([
                    'univ' => ['univ' => 'univ', 'rules' => 'required|min_length[11]', 'errors' => ['required' => 'Asal universitas wajib diisi.']],
                    'payment' => ['payment' => 'payment', 'rules' => ['uploaded[payment]','is_image[payment,image/jpg,image/jpeg,image/png]'], 'errors' => ['is_image' => 'Gambar tidak sesuai.']],
                    'phone' => ['phone' => 'phone', 'rules' => ['required','numeric'], 'errors' => ['required' => 'No. handphone wajib diisi.']],
                    'line' => ['line' => 'line', 'rules' => 'required', 'errors' => ['required' => 'ID Line wajib diisi.']],
			    ]);
            }

			$isValid = $validation->withRequest($this->request)->run();

            if($isValid){

                $ktm = $this->request->getFile('ktm');
                if(is_file($ktm)){
                    $ktmFile = $ktm->getRandomName();
                    $ktm->move('uploads/media/user/ktm/', $ktmFile);
                }else{
                    $ktmFile = $data_member['ktm'];
                }
                $member->set([
                    'ktm' => $ktmFile,
                    'id_line' => $this->request->getVar('line'),
                    'univ' => $this->request->getVar('univ'),
                    'nim' => $this->request->getVar('nim'),
                    'phone' => $this->request->getVar('phone')
                ]);
                $member->where('id_member', preg_replace('/\s+/', '', $this->request->getVar('id_member')));
                $member->update();

                $payment = $this->request->getFile('payment');
                if(is_file($payment)){
                    $paymentFile = $payment->getRandomName();
                    $payment->move('uploads/media/lomba/payment/', $paymentFile);
                }
                $regist->insert([
                    'id_member' => preg_replace('/\s+/', '', $this->request->getVar('id_member')),
                    'id_lomba' => preg_replace('/\s+/', '', $this->request->getVar('id_lomba')),
                    'status' => 'pending',
                    'payment' => $paymentFile
                ]);
            }else{
                $session->setFlashdata('univ', $validation->getError('univ'));
				$session->setFlashdata('ktm', $validation->getError('ktm'));
				$session->setFlashdata('phone', $validation->getError('phone'));
				$session->setFlashdata('line', $validation->getError('line'));
                $session->setFlashdata('payment', $validation->getError('payment'));
				return redirect()->back()->withInput();
            }
		}
        return redirect()->back();
    }

    public function Submission($slug){
        $lomba = new LombaMod();
        $lomba->select('*');
        $lomba->where('lomba.slug',"$slug");
        $data['lomba'] = $lomba->get()->getFirstRow();

        $regist = new RegistrationMod();
        $regist->select('*, registration.status as regist_status');
        $regist->join('lomba',"lomba.id_lomba = registration.id_lomba");
        $regist->where('id_member',session()->get('id'));
        $regist->where('registration.id_lomba',$data['lomba']->id_lomba);
        $data['regist'] = $regist->get()->getFirstRow();

        $submit = new SubmissionMod();
        $submit->select('*');
        $submit->where('id_regist',$data['regist']->id_regist);
        $data['submission'] = $submit->get()->getFirstRow();

        $member = new MemberMod();
        $member->select('*');
        $member->where('id_member',session()->get('id'));
        $data['user'] = $member->get()->getFirstRow();

        return view('publics/lomba/registDetail',$data);
    }

    public function SubmitLomba(){
        $submit = new SubmissionMod();
        $regist = new RegistrationMod();

        if (!empty($_POST)) {
            $session = session();
            $validation =  \Config\Services::validation();
            
            if(preg_replace('/\s+/', '', $this->request->getVar('type')) === 'image'){
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
			    ]);
            }elseif(preg_replace('/\s+/', '', $this->request->getVar('type')) === 'pdf'){
                $validation->setRules([
				    'title' => ['title' => 'title', 'rules' => 'required', 'errors' => ['required' => 'Judul karya wajib diisi.']],
                    'karya' => ['karya' => 'karya', 'rules' => ['uploaded[karya]','ext_in[karya,pdf]'], 
                            'errors' => ['ext_in' => 'Format file tidak sesuai.','uploaded' => 'Karya wajib disertakan.']
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
                    $thumbnail->move("uploads/submission/".trim($this->request->getVar('slug')).'/', $thumbnailFile.'-thumbnail');
                }else{
                    $thumbnailFile = null;
                }
                var_dump($thumbnailFile);
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
				$session->setFlashdata('karya', $validation->getError('karya'));
				$session->setFlashdata('title', $validation->getError('title'));
                $session->setFlashdata('thumbnail', $validation->getError('thumbnail'));

				return redirect()->back()->withInput();
            }
        }
       return redirect()->back();
    }
}   