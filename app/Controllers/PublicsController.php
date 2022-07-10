<?php namespace App\Controllers;

class PublicsController extends BaseController
{

    function __construct()
    {
        helper('form','url');
        $this->session = \Config\Services::session();
    }

	public function HomePage(){
        return view('publics/homepage/landing');
    }
}   
    