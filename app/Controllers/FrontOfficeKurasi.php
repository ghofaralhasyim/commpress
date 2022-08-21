<?php namespace App\Controllers;

use App\Models\PameranMod;

class FrontOfficeKurasi extends BaseController
{

    function __construct()
    {
		if (session()->get('role') != "curator") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
    }

    public function index(){
        return view('publics/kurasi/index');
    }

    public function fotoTunggal(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','foto-tunggal');
        
        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/kurasi/foto-tunggal',$data);
    }

     public function videoDokumenter(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','video-dokumenter');

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/kurasi/video-dokumenter',$data);
    }

    public function infoGrafik(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','info-grafik');

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/kurasi/info-grafik',$data);
    }

    public function kolaseDigital(){
        $pameran = new PameranMod();
        $pameran->select('*, submission.thumbnail as thumbnail_karya');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('pameran.slug','kolase-digital');

        $data['data'] = $pameran->paginate(9,'data');
        $data['pager'] = $pameran->pager;

        return view('publics/kurasi/kolase-digital',$data);
    }

}   