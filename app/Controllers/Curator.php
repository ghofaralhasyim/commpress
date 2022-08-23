<?php namespace App\Controllers;

use App\Libraries\Breadcrumb;
use App\Models\PameranMod;
use App\Models\SubmissionMod;

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

    public function Details($slug){
        $pameran = new PameranMod();
        $pameran->select('*, member.name as participant');
        $pameran->join('registration','pameran.id_pameran = registration.id_pameran');
        $pameran->join('submission','submission.id_regist = registration.id_regist');
        $pameran->join('member','member.id_member = registration.id_member');
        $pameran->where('slug',$slug);
        $data['data_submit'] = $pameran->paginate(1,'data_submit');
        $data['pager'] = $pameran->pager;

        $pameran->select('*');
        $data['pameran'] = $pameran->get()->getResult();

        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();
        return view('curator/page/_slug',$data);
    }

    public function Qualifier($id){
        $submission = new SubmissionMod();
        $submission->select('qualified');
        $submission->where('id_submission',$id);
        $qualified = $submission->get()->getFirstRow();

        $qualified->qualified == 0 ? $submission->set('qualified',1) : $submission->set('qualified',0);
        $submission->where('id_submission',$id);
        $submission->update();

        $session = session();
        $session->setFlashdata('qualifier', $id );

        return redirect()->back();
    }
}