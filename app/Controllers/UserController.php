<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserMod;

class UserController extends BaseController
{
    public function Masuk()
    {
        $data = [];

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'email' => [
                    'required' => "Email wajib diisi.",
                    'valid_email' => "Email tidak valid."
                ],
                'password' => [
                    'validateUser' => "Email atau Password tidak sesuai.",
                    'required' => "Password wajib diisi."
                ],
            ];

            if (!$this->validate($rules, $errors)) {
                return redirect()->back()->withInput()->with('email', $this->validator->getError('email'))
                ->with('password', $this->validator->getError('password')); 
            } else {
                $model = new UserMod();

                $user = $model->where('email', $this->request->getVar('email'))
                    ->first();

                // Stroing session values
                $this->setUserSession($user);

                // Redirecting to dashboard after login
                if($user['role'] == "panitia"){

                    return redirect()->to(base_url('dashboard'));

                }elseif($user['role'] == "peserta"){

                    return redirect()->to(base_url('member'));
                }
            }
        }
        return view('publics/masuk');
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id_member'],
            'name' => $user['name'],
            'phone' => $user['phone'],
            'line' => $user['id_line'],
            'ktm' => $user['ktm'],
            'email' => $user['email'],
            'univ' => $user['univ'],
            'nim' => $user['nim'],
            'logged_in' => true,
            'picture' => $user['picture'],
            "role" => $user['role'],
        ];

        session()->set($data);
        return true;
    }

    public function Daftar()
	{	
		if (!empty($_POST)) {
            $session = session();
            $member = new UserMod();
            $validation =  \Config\Services::validation();
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
                    'role' => 'peserta',
					'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
				]);
				$data = $member->where('email', $this->request->getVar('email'))->first();
                $this->setUserSession($data);
				return redirect()->to(base_url('member'));
			} else {
				$session->setFlashdata('nameError', $validation->getError('name'));
				$session->setFlashdata('emailError', $validation->getError('email'));
				$session->setFlashdata('pwdError', $validation->getError('password'));
				$session->setFlashdata('pwdConfError', $validation->getError('confirmPassword'));
				return redirect()->back()->withInput();
			}
		}
		return view('/publics/daftar');
	}

    public function keluar()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}