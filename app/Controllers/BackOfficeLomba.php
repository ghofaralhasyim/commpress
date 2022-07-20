<?php namespace App\Controllers;

use App\Models\LombaMod;
use App\Models\RegistrationMod;
use App\Libraries\Breadcrumb;
use App\Models\SubmissionMod;

class BackOfficeLomba extends BaseController
{
    protected $session;
    public $breadcrumb;
    
    function __construct()
    {
        if (session()->get('role') != "panitia") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
        $this->breadcrumb = new Breadcrumb();
    }

	public function Lomba(){
        $lomba = new LombaMod();

        $lomba->select('*, COUNT(id_regist) as participant, lomba.status as status');
        $lomba->join('registration', 'registration.id_lomba = lomba.id_lomba','left');
        $lomba->groupBy('lomba.id_lomba');

        $data['listLomba'] = $lomba->get()->getResult();
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();

        return view('admin/page/lomba/lomba',$data);
    }

    public function Details($slug){
        $regist = new RegistrationMod();
        $lomba = new LombaMod();

        $regist->select('*, registration.status as status, registration.payment as payment');
        $regist->join('lomba',"lomba.slug = '$slug'");
        $regist->join('member',"member.id_member = registration.id_member");
        $regist->where('registration.id_lomba = lomba.id_lomba');
        $regist->orderBy('registration.status',"desc");
        $data['listRegist'] = $regist->get()->getResult();

        $lomba->select('*');
        $lomba->where('lomba.slug',"$slug");
        $data['lomba'] = $lomba->get()->getFirstRow();
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();

        return view('admin/page/lomba/details',$data);
    }

    public function UpdateArticle($slug){
        $lomba = new LombaMod();
        $session = session();

        if($slug != 'new'){
            $media = $this->request->getFile('media');
            if(is_file($media)){
                $fileName = $media->getRandomName();
                $media->move('uploads/media/lomba/thumbnail/', $fileName);
                $lomba->set('media', $fileName);
            }
            $lomba->set('description', $this->request->getVar('description'));
            $lomba->set('name', $this->request->getVar('name'));
            $lomba->set('slug', strtolower(preg_replace('/\s+/', '-', $this->request->getVar('name'))));
            $lomba->set('status', $this->request->getVar('status'));
            $lomba->set('type_submission', $this->request->getVar('type'));
            $lomba->where('slug', "$slug");
            $lomba->update();
            $session->setFlashdata('success', "$slug has been updated!");
        }elseif($slug == 'new'){
            $media = $this->request->getFile('media');
            $banner = $this->request->getFile('banner');
            $bannerName = $banner->getRandomName();
            $fileName = $media->getRandomName();
            $media->move('uploads/media/lomba/thumbnail/', $fileName);
            $banner->move('uploads/media/lomba/banner/', $bannerName);
            $lomba->insert([
                'name' => $this->request->getVar('name'),
                'slug' => strtolower(preg_replace('/\s+/', '-', $this->request->getVar('name'))),
                'status' => $this->request->getVar('status'),
                'description' => $this->request->getVar('description'),
                'type_submission' =>  $this->request->getVar('type'),
                'media' => $fileName,
                'banner' => $bannerName
            ]);

            return redirect()-> to("dashboard/lomba");
        }

         return redirect()->to("/dashboard/lomba/$slug");
    }

    public function UpdateBanner($slug){
        $lomba = new LombaMod();

        $media = $this->request->getFile('banner');
        $fileName = $media->getRandomName();    

        $lomba->set('banner', $fileName);
        $lomba->where('slug', "$slug");
        $lomba->update();

        $media->move('uploads/media/lomba/banner/', $fileName);

        return redirect()->to("/dashboard/lomba/$slug");
    }

    public function UpdateStatus($status,$id){
        $regist = new RegistrationMod();
        if($status == 'confirm'){
            $regist->set('status','confirmed');
        }elseif($status == 'reject'){
            $regist->set('status','rejected');
        }
        $regist->where('id_regist',$id);
        $regist->update();

        return redirect()->back();
    }

    public function Participant($slug,$id){
        $regist = new RegistrationMod();
        $regist->select('*, registration.status as regist_status');
        $regist->join('member','member.id_member = registration.id_member');
        $regist->join('lomba','lomba.id_lomba = registration.id_lomba');
        $regist->where('registration.id_regist',$id);
        $data['regist'] = $regist->get()->getFirstRow();

        $submit = new SubmissionMod();
        $submit->select('*');
        $submit->where('id_regist',$id);
        $data['submission'] = $submit->get()->getFirstRow();

        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();
        return view('admin/page/lomba/participant',$data);
    }
   
}