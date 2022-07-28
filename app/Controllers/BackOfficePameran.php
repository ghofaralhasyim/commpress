<?php namespace App\Controllers;

use App\Models\PameranMod;
use App\Models\RegistrationMod;
use App\Libraries\Breadcrumb;
use App\Models\SubmissionMod;

class BackOfficePameran extends BaseController
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

	public function Index(){
        $pameran = new PameranMod();

        $pameran->select('*, COUNT(id_regist) as participant, pameran.status as status');
        $pameran->join('registration', 'registration.id_pameran = pameran.id_pameran','left');
        $pameran->groupBy('pameran.id_pameran');

        $data['listPameran'] = $pameran->get()->getResult();
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();

        return view('admin/page/pameran/index',$data);
    }

     public function UpdatePameran($slug){
        $pameran = new PameranMod();
        $session = session();

        if($slug != 'new'){
            $thumbnail = $this->request->getFile('thumbnail');
            if(is_file($thumbnail)){
                $fileName = $thumbnail->getRandomName();
                $thumbnail->move('uploads/media/pameran/thumbnail/', $fileName);
                $pameran->set('media', $fileName);
            }
            $pameran->set('description', $this->request->getVar('description'));
            $pameran->set('status', $this->request->getVar('status'));
            $pameran->set('type_submission', $this->request->getVar('type'));
            $pameran->where('slug', "$slug");
            $pameran->update();
            $session->setFlashdata('success', "$slug has been updated!");
        }elseif($slug == 'new'){
            $thumbnail = $this->request->getFile('thumbnail');
            $banner = $this->request->getFile('banner');
            $bannerName = $banner->getRandomName();
            $fileName = $thumbnail->getRandomName();
            $thumbnail->move('uploads/media/pameran/thumbnail/', $fileName);
            $banner->move('uploads/media/pameran/banner/', $bannerName);
            $pameran->insert([
                'name' => $this->request->getVar('name'),
                'slug' => strtolower(preg_replace('/\s+/', '-', $this->request->getVar('name'))),
                'status' => $this->request->getVar('status'),
                'description' => $this->request->getVar('description'),
                'type_submission' =>  $this->request->getVar('type'),
                'thumbnail' => $fileName,
                'banner' => $bannerName
            ]);

            return redirect()-> to("dashboard/pameran");
        }

         return redirect()->to("/dashboard/pameran/$slug");
    }
   
     public function Details($slug){
        $regist = new RegistrationMod();
        $pameran = new PameranMod();

        $regist->select('*, registration.status as status, registration.payment as payment');
        $regist->join('pameran',"pameran.slug = '$slug'");
        $regist->join('member',"member.id_member = registration.id_member");
        $regist->where('registration.id_pameran = pameran.id_pameran');
        $regist->orderBy('registration.status',"desc");
        $data['listRegist'] = $regist->get()->getResult();

        $pameran->select('*');
        $pameran->where('pameran.slug',"$slug");
        $data['pameran'] = $pameran->get()->getFirstRow();
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();

        return view('admin/page/pameran/details',$data);
    }

     public function UpdateBanner($slug){
        $pameran = new PameranMod();
        $session = session();
        $validation =  \Config\Services::validation();

        $banner = $this->request->getFile('banner');

        $validation->setRules([
            'banner' => ['banner' => 'banner', 'rules' => ['uploaded[banner]','is_image[banner,image/jpg,image/jpeg,image/png]'], 
                    'errors' => ['is_image' => 'Format gambar tidak sesuai.','uploaded' => 'File wajib diisi.']
            ],
		]);

        $isValid = $validation->withRequest($this->request)->run();
        if($isValid){
            if(is_file($banner)){
                $fileName = $banner->getRandomName();  
                $banner->move('uploads/media/pameran/banner/', $fileName);
            }else{
                $fileName = null;
            }
            $pameran->set('banner', $fileName);
            $pameran->where('slug', "$slug");
            $pameran->update();
        }else{
            $session->setFlashdata('banner', $validation->getError('banner'));

			return redirect()->back()->withInput();
        }
        return redirect()->to("/dashboard/pameran/$slug");
    }

    public function Participant($slug,$id){
        $regist = new RegistrationMod();
        $regist->select('*, member.name as member_name, registration.status as regist_status');
        $regist->join('member','member.id_member = registration.id_member');
        $regist->join('pameran','pameran.id_pameran = registration.id_pameran');
        $regist->where('registration.id_regist',$id);
        $data['regist'] = $regist->get()->getFirstRow();

        $submit = new SubmissionMod();
        $submit->select('*');
        $submit->where('id_regist',$id);
        $data['submission'] = $submit->get()->getFirstRow();

        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();
        return view('admin/page/pameran/participant',$data);
    }
}