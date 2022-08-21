<?php namespace App\Controllers;

use App\Models\LombaMod;
use App\Models\MediaMod;
use App\Models\MedsponMod;

class PublicsController extends BaseController
{

    function __construct()
    {
        helper('form','url');
        $this->session = \Config\Services::session();
    }

	public function HomePage(){
        $lomba = new LombaMod();
        $lomba->select('*');
        $data['lomba'] = $lomba->get()->getResult();

        $medrel = new MediaMod();
        $medrel->select('*');
        $data['media'] = $medrel->get()->getResult();

        $media = new MedsponMod();
        $media->select('*');
        $data['media_sponsor'] = $media->get()->getResult();

        return view('publics/index',$data);
    }
}   
    