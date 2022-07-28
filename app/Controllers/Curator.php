<?php namespace App\Controllers;

use App\Libraries\Breadcrumb;
use App\Models\PameranMod;

class Curator extends BaseController
{

    function __construct()
    {
		if (session()->get('role') != "curator") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
        $this->breadcrumb = new Breadcrumb();
    }

    public function index(){
        $pameran = new PameranMod();
        $pameran->select('*');
        $data['pameran'] = $pameran->get()->getResult();
        
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();
        return view('curator/index',$data);
    }
}