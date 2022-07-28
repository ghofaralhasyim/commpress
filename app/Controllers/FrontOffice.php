<?php namespace App\Controllers;

use App\Models\WebSettings;
use App\Models\LombaMod;
use App\Models\MediaMod;
use App\Models\PameranMod;
use App\Models\MemberMod;
use App\Models\RegistrationMod;

class FrontOffice extends BaseController
{

    function __construct()
    {
		if (session()->get('role') != "peserta") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
    }

    public function HomePage(){
        return view('publics/homepage/landing');
    }
    
	public function Member(){
        $data = array();

		$settings = new WebSettings();
        $settings->select('*');
        $results = $settings->get()->getResult();

        $lomba = new LombaMod();
        $lomba->select('*');
        $data['lomba'] = $lomba->get()->getResult();

        $pameran = new PameranMod();
        $pameran->select('*');
        $data['pameran'] = $pameran->get()->getResult();

        $medrel = new MediaMod();
        $medrel->select('*');
        $data['media'] = $medrel->get()->getResult();

        foreach($results as $temp){
            $data[$temp->key_settings] = $temp;
        }
		return view('/publics/member',$data);
	}

    public function Account(){
        $member = new MemberMod();
        $member->select('*');
        $member->where('member.id_member',session()->get('id'));
        $data['member'] = $member->get()->getFirstRow();

        return view('publics/akun',$data);
    }

    public function EditAccount(){
        $member = new MemberMod();

       if (!empty($_POST)) {
            $session = session();
            $validation =  \Config\Services::validation();

            $ktm = $this->request->getFile('ktm');
            if(is_file($ktm)){
                $validation->setRule('ktm', 'ktm', 'uploaded[ktm]|is_image[ktm,image/jpg,image/jpeg,image/png]|max_size[ktm,2048]');
                $ktmValid = $validation->withRequest($this->request)->run();
            }else{
                $ktmValid = true;
            }

            $picture = $this->request->getFile('foto');
            if(is_file($picture)){
                $validation->setRule('foto', 'foto', 'uploaded[foto]|is_image[foto,image/jpg,image/jpeg,image/png]|max_size[foto,1024]');
                $pictValid = $validation->withRequest($this->request)->run();
            }else{
                $pictValid = true;
            }

            $validation->setRules([
				'name' => ['name' => 'name', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Nama wajib diisi.', 'min_length' => 'Nama minimal 5 karakter']],
                'email' => [
					'email' => 'email',
					'rules' => 'required|valid_email',
					'errors' => [
						'required' => 'Email wajib diisi.',
						'valid_email' => 'Email tidak valid.'
						]
				],
                'univ' => ['univ' => 'univ', 'rules' => 'required', 'errors' => ['required' => 'Universitas wajib diisi.']],
                'phone' => ['phone' => 'phone', 'rules' => 'required', 'errors' => ['required' => 'No. handphone wajib diisi.']],
                'line' => ['line' => 'line', 'rules' => 'required', 'errors' => ['required' => 'ID Line wajib diisi.']],
			]);

            $isValid = $validation->withRequest($this->request)->run();
            if ($isValid && $pictValid && $ktmValid) {
                if(is_file($ktm)){
                    $ktmFile = $ktm->getRandomName();
                    var_dump($ktmFile);
                    $ktm->move('uploads/media/user/ktm/', $ktmFile);
                }else{
                    $ktmFile = $ktmFile = $this->request->getVar('ktmName');
                }
                if(is_file($picture)){
                    $pictureFile = $picture->getRandomName();
                    var_dump($pictureFile);
                    $picture->move('uploads/media/user/profile-picture/', $pictureFile);
                }else{
                    $pictureFile = $this->request->getVar('pictName');
                }
				$member->set([
					'name' => trim($this->request->getVar('name')),
					'email' => trim($this->request->getVar('email')),
					'univ' => trim($this->request->getVar('univ')),
                    'phone' => trim($this->request->getVar('phone')),
                    'id_line' => trim($this->request->getVar('line')),
                    'ktm' => $ktmFile,
                    'picture' => $pictureFile
				]);
                $member->where('id_member', session()->get('id'));
                $member->update();
				return redirect()->to(base_url('member/akun'));
			} else {
				$session->setFlashdata('nameError', $validation->getError('name'));
				$session->setFlashdata('emailError', $validation->getError('email'));
				$session->setFlashdata('univError', $validation->getError('univ'));
				$session->setFlashdata('phoneError', $validation->getError('phone'));
                $session->setFlashdata('lineError', $validation->getError('line'));
                $session->setFlashdata('fotoError', $validation->getError('foto'));
                $session->setFlashdata('error', true);
				return redirect()->back()->withInput();
			}
        }
        return redirect()->back();
    }

     public function Submission(){
        $regist = new RegistrationMod();
        $regist->select('*, registration.status as regist_status');
        $regist->join('lomba',"lomba.id_lomba = registration.id_lomba");
        $regist->where('id_member',session()->get('id'));
        $data['lomba_regist'] = $regist->get()->getResult();

        $regist->select('*, registration.status as regist_status');
        $regist->join('pameran',"pameran.id_pameran = registration.id_pameran");
        $regist->where('id_member',session()->get('id'));
        $data['pameran_regist'] = $regist->get()->getResult();

        $lomba = new LombaMod();
        $lomba->select('*');
        $data['lomba'] = $lomba->get()->getResult();

        $pameran = new PameranMod();
        $pameran->select('*');
        $data['pameran'] = $pameran->get()->getResult();

        $regist->select('id_regist');
        $regist->where('id_lomba!=',NULL);
        $regist->where('id_member',session()->get('id'));
        $data['count_lomba'] = $regist->countAllResults();

        $regist->select('id_regist');
        $regist->where('id_pameran!=',NULL);
        $regist->where('id_member',session()->get('id'));
        $data['count_pameran'] = $regist->countAllResults();

        return view('publics/submission',$data);
    }
}   