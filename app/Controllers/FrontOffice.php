<?php namespace App\Controllers;

use App\Models\WebSettings;
use App\Models\LombaMod;

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

        foreach($results as $temp){
            $data[$temp->key_settings] = $temp;
        }
		return view('/publics/member',$data);
	}

    public function DetailsLomba($slug){
        $lomba = new LombaMod();
        $lomba->select('*');
        $lomba->where('lomba.slug',"$slug");
        $data['data'] = $lomba->get()->getFirstRow();

		return view('publics/lomba/details',$data);
	}
}   