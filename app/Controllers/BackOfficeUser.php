<?php namespace App\Controllers;

use App\Models\Admin_Mod;
use App\Models\DataOprec_Mod;

class BackOfficeUser extends BaseController
{
    protected $session;
    
    function __construct()
    {
        if (session()->get('role') != "panitia") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
    }

	public function Login()
	{
		$session = session();
		$user = new Admin_Mod();
		$validation =  \Config\Services::validation();

		if (!empty($_POST)) {
			$validation->setRules([
				'username' => ['username' => 'username', 'rules' => 'required'],
				'password' => ['password' => 'password', 'rules' => 'required'],
			]);

			$isValid = $validation->withRequest($this->request)->run();

			if ($isValid) {
				$pass = $this->request->getVar('password');
				$username = $this->request->getVar('username');
				$data = $user->where('username', $username)->first();
				if ($data) {
					$pass_db = $data['password'];
					$verify = password_verify($pass, $pass_db);
					if ($verify) {
						$session_data = [
							'id_user' => $data['id_user'],
							'username' => $data['username'],
                            'divisi' => $data['divisi'],
                            'logged_in' => TRUE,
						];
						$session->set($session_data);
						return redirect()->to(base_url('/dashboard/oprec'));
					} else {
						$session->setFlashdata('error', 'wrong password');
						return redirect()->back()->withInput();
					}
				} else {
					$session->setFlashdata('error', 'Username not found');
					return redirect()->back()->withInput();
				}
			} else {
				$this->session->setFlashdata('error', $validation->listErrors());
                return redirect()->back()->withInput();
			}
		}
		return view('admin/login');
	}

    public function Logout()
    {
        $this->session->destroy();
        return redirect()->to('/');
    }

    public function Dashboard() 
    {
        return view('/admin/dashboard');
    }

    public function Oprec() 
    {
        $oprec = new DataOprec_Mod();
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'name' => ['name' => 'name', 'rules' => 'required'],
            'nim' => ['nim' => 'nim', 'rules' => 'required'],
            'divisi' => ['divisi' => 'divisi', 'rules' => 'required'],
        ]);

        if (!empty($_POST)) {
            $isValid = $validation->withRequest($this->request)->run();

            if($isValid){
                $name = $this->request->getVar('name');
                $nim = $this->request->getVar('nim');
                $divisi = $this->request->getVar('divisi');
                $oprec->insert([
                    'name' => $name,
                    'nim' => $nim,
                    'divisi' => $divisi,
                ]);
                
                return redirect()->to('/dashboard/oprec');
            }else{
                if($validation->hasError('name')) {
                    $this->session->setFlashdata('nameError', $validation->getError('name'));
                }
                if($validation->hasError('nim')) {
                    $this->session->setFlashdata('nimError', $validation->getError('nim'));
                }
                return redirect()->back()->withInput();
            }
        }

        $oprec->select('*');
        $data['dataOprec'] = $oprec->get()->getResult();

        return view('/admin/page/oprecManagement', $data);
    }
    
    public function EditDataPanit($id_panit) {
        $oprec = new DataOprec_Mod();
        $validation =  \Config\Services::validation();

        $oprec->select('*');
        $oprec->where('id',$id_panit);
        $data['dataPanit'] = $oprec->first();

        $validation->setRules([
            'name' => ['name' => 'name', 'rules' => 'required'],
            'nim' => ['nim' => 'nim', 'rules' => 'required'],
            'divisi' => ['divisi' => 'divisi', 'rules' => 'required'],
        ]);
        if (!empty($_POST)) {
            $name = $this->request->getVar('name');
            $nim = $this->request->getVar('nim');
            $divisi = $this->request->getVar('divisi');

            $oprec->set([
                'name' => $name,
                'nim' => $nim,
                'divisi' => $divisi
            ]);
            $oprec->where('id',$id_panit);
            $oprec->update();

            $this->session->setFlashdata('success','Data updated');
            return redirect()->to("/dashboard/edit-data-panit/$id_panit");
        }
        return view('admin/component/edit_dataPanit',$data);
    }

    public function DeleteDataPanit($id_panit){
        $oprec = new DataOprec_Mod();
        $oprec->where('id',$id_panit);
        $oprec->delete();

        return redirect()->to(base_url('dashboard/oprec'));
    }
}