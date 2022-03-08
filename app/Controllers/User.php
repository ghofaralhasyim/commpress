<?php namespace App\Controllers;

use App\Models\DataOprec_Mod;

class User extends BaseController
{

    function __construct()
    {
        helper('form','url');
        $this->session = \Config\Services::session();
    }

	public function OprecResult()
	{
        $session = session();
        $dataOprec = new DataOprec_Mod();
		$validation =  \Config\Services::validation();

			$validation->setRules([
				'nim' => ['nim' => 'nim', 'rules' => 'required']
			]);

			$isValid = $validation->withRequest($this->request)->run();

			if($isValid){
				$nim = $this->request->getVar('nim');
                $data['dataPanit'] = $dataOprec->where('nim',$nim)->first();

                if($data['dataPanit'] != null){
                    return view('publics/oprec/oprec_result',$data);
                }else{
                    $session->setFlashdata('msg', 'tryagain');
                    return view('publics/oprec/oprec_result',$data);
                }
			}else{
                return redirect()->to(base_url('/'));
            }
	}

    public function About(){
        return view('publics/oprec/about');
    }
}