<?php namespace App\Controllers;

use App\Models\MediaMod;
use CodeIgniter\I18n\Time;

class FrontOfficeMedia extends BaseController
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

    public function media($slug){
        $media = new MediaMod();
        $media->select('*');
        $media->where('slug',$slug);
        $data['content'] = $media->get()->getFirstRow();
        return view('publics/media/_slug',$data);
    }
}