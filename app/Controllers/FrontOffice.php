<?php namespace App\Controllers;

use App\Models\MemberMod;
use CodeIgniter\I18n\Time;

class FrontOffice extends BaseController
{

    function __construct()
    {
        helper('form','url');
        $this->session = \Config\Services::session();
    }

    public function HomePage(){
        return view('publics/homepage/landing');
    }

    public function Masuk()
	{
		if(session()->get('logged_in')){
			return redirect()->to(base_url('/member'));
		}

		$session = session();
		$member = new MemberMod();
		$validation =  \Config\Services::validation();

		if (!empty($_POST)) {
			$validation->setRules([
				'email' => ['email' => 'email', 'rules' => 'required'],
				'password' => ['password' => 'password', 'rules' => 'required'],
			]);

			$isValid = $validation->withRequest($this->request)->run();

			if ($isValid) {
				$pass = $this->request->getVar('password');
				$user = $this->request->getVar('email');
				$data = $member->where('email', $user)->first();
				if ($data) {
					$pass_db = $data['password'];
					$verify = password_verify($pass, $pass_db);
					if ($verify) {
						$session_data = [
							'id_member' => $data['id_member'],
							'email' => $data['email'],
							'logged_in' => TRUE,
						];
						$session->set($session_data);
						return redirect()->to(base_url('/member'));
					} else {
						$session->setFlashdata('error', 'Password Salah');
						return redirect()->back()->withInput();
					}
				} else {
					$session->setFlashdata('error', 'Email tidak ditemukan.');
					return redirect()->back()->withInput();
				}
			} else {
				$this->session->setFlashdata('emailError', $validation->getError('email'));
				$this->session->setFlashdata('pwdError', $validation->getError('password'));
			}
			 return redirect()->back()->withInput();
		}
		return view('/publics/masuk');
	}

	public function Daftar()
	{	
		if(session()->get('logged_in')){
			return redirect()->to(base_url('/member'));
		}

		$session = session();
		$member = new MemberMod();
		$validation =  \Config\Services::validation();

		if (!empty($_POST)) {
			$validation->setRules([
				'name' => ['name' => 'name', 'rules' => 'required', 'errors' => ['required' => 'Nama wajib diisi.']],
				'email' => [
					'email' => 'email',
					'rules' => 'required|valid_email',
					'errors' => [
						'required' => 'Email wajib diisi.',
						'valid_email' => 'Email tidak valid.'
						]
				],
				'password' => ['password' => 'password', 'rules' => 'required', 'errors' => ['required' => 'Password wajib diisi.']],
				'confirmPassword' => [
					'confirmPassword' => 'confirmPassword',
					'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'Mohon konfirmasi password.',
						'matches' => 'Konfirmasi password tidak sesuai.'
						]
				],
			]);

			$isValid = $validation->withRequest($this->request)->run();

			if ($isValid && !empty($_POST)) {

				$member->insert([
					'name' => $this->request->getVar('name'),
					'email' => $this->request->getVar('email'),
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
				]);
				$data = $member->where('email', $this->request->getVar('email'))->first();
				$session_data = [
							'id_member' => $data['id_member'],
							'email' => $data['email'],
							'logged_in' => TRUE,
						];
				$session->set($session_data);
				return redirect()->to(base_url('/member'));
			} else {
				$this->session->setFlashdata('nameError', $validation->getError('name'));
				$this->session->setFlashdata('emailError', $validation->getError('email'));
				$this->session->setFlashdata('pwdError', $validation->getError('password'));
				$this->session->setFlashdata('pwdConfError', $validation->getError('confirmPassword'));
				return redirect()->back()->withInput();
			}
		}
		return view('/publics/daftar');
	}

	public function Member(){
		return view('/publics/member');
	}

	public function Keluar(){
		$time = new Time('now');
		$member = new MemberMod();

		$member->set(['last_login' => $time]);
		$member->where('email',session()->get('email'));
		$member->update();


		$this->session->destroy();
        return redirect()->to('/');
	}
}   