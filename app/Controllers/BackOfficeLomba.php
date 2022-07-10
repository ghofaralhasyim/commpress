<?php namespace App\Controllers;

use App\Models\LombaMod;
use App\Models\RegistrationMod;

class BackOfficeLomba extends BaseController
{
    protected $session;
    
    function __construct()
    {
        if (session()->get('role') != "panitia") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
    }

	public function Lomba(){
        $lomba = new LombaMod();

        $lomba->select('*, COUNT(id_regist) as participant, lomba.status as status');
        $lomba->join('registration', 'registration.id_lomba = lomba.id_lomba','left');
        $lomba->groupBy('lomba.id_lomba');

        $data['listLomba'] = $lomba->get()->getResult();

        return view('admin/page/lomba/lomba',$data);
    }

    public function Details($slug){
        $regist = new RegistrationMod();
        $lomba = new LombaMod();

        $regist->select('*, registration.status as status, registration.media as payment');
        $regist->join('lomba',"lomba.slug = '$slug'");
        $regist->join('member',"member.id_member = registration.id_member");
        $regist->where('registration.id_lomba = lomba.id_lomba');
        $data['listRegist'] = $regist->get()->getResult();

        $lomba->select('*');
        $lomba->where('lomba.slug',"$slug");
        $data['lomba'] = $lomba->get()->getFirstRow();

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
   
}