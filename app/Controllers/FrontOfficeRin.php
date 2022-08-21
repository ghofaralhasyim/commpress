<?php namespace App\Controllers;

use App\Models\LombaMod;
use App\Models\PameranMod;

class FrontOfficeRin extends BaseController
{

    function __construct()
    {
		if (session()->get('role') != "peserta" && session()->get('role') != "curator") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
    }

    public function index(){
        return view('publics/ruang-independen/index');
    }

    public function fotoTunggal(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','foto-tunggal');
        $pameran->where('submission.qualified','1');

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/ruang-independen/foto-tunggal',$data);
    }

     public function videoDokumenter(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','video-dokumenter');
        $pameran->where('submission.qualified','0'); #CHANGE LATER!

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/ruang-independen/video-dokumenter',$data);
    }

    public function infoGrafik(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','info-grafik');
        $pameran->where('submission.qualified','1'); 

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/ruang-independen/info-grafik',$data);
    }

    public function kolaseDigital(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','kolase-digital');
        $pameran->where('submission.qualified','0');  #CHANGE LATER!

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/ruang-independen/kolase-digital',$data);
    }

    public function Details($slug){
        return view('publics/ruang-independen/_details');
    }
}   