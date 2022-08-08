<?php namespace App\Controllers;

use App\Models\LombaMod;

class FrontOfficeRin extends BaseController
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

    public function index(){
        $lomba = new LombaMod();
        $lomba->select('*');
        $data['lomba'] = $lomba->get()->getResult();

        return view('publics/pameran/index',$data);
    }

    public function fotoTunggal(){
        return view('publics/pameran/foto-tunggal');
    }

}   