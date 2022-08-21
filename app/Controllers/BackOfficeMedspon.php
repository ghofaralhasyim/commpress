<?php namespace App\Controllers;

use App\Libraries\Breadcrumb;
use App\Models\MedsponMod;

class BackOfficeMedspon extends BaseController
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

    public function index(){
        $media = new MedsponMod();
        $media->select('*');

        $data['media'] = $media->get()->getResult();
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();

        return view('admin/page/media-sponsor/index', $data);
    }

    public function Save(){
        $media = new MedsponMod();
        $session = session();
        $validation =  \Config\Services::validation();

        $validation->setRules([
            'name' => ['name' => 'name', 'rules' => 'required', 'errors' => ['required' => 'Name field is required.']],
            'image' => ['image' => 'image', 'rules' => ['uploaded[image]','is_image[image,image/jpg,image/jpeg,image/png]'], 'errors' => ['is_image' => 'Gambar tidak sesuai.']],
        ]);
        $isValid = $validation->withRequest($this->request)->run();

        if($isValid){
            $image = $this->request->getFile('image');
            if(is_file($image)){
                $imageFile = $image->getRandomName();
                $image->move('uploads/media/media_sponsor', $imageFile);
            }
            $media->insert([
                'name' => $this->request->getVar('name'),
                'url' => $this->request->getVar('url'),
                'media' => $imageFile
            ]);
        }else{
            $session->setFlashdata('error',true);
            $session->setFlashdata('name', $validation->getError('name'));
            $session->setFlashdata('url', $validation->getError('url'));
            $session->setFlashdata('image', $validation->getError('image'));
            return redirect()->back()->withInput();
        }
        return redirect()->back();
    }

    public function Edit($id){
        $media = new MedsponMod();
        $media->select('*');
        $media->where('id_media_sponsor',$id);
        $data['media'] = $media->get()->getFirstRow();

        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();

        return view('admin/page/media-sponsor/edit', $data);
    }

    public function Update(){
        $media = new MedsponMod();

        $session = session();
        $validation =  \Config\Services::validation();
        $image = $this->request->getFile('image');

        if(is_file($image)){
            $validation->setRules([
                'name' => ['name' => 'name', 'rules' => 'required', 'errors' => ['required' => 'Name field is required.']],
                'image' => ['image' => 'image', 'rules' => ['uploaded[image]','is_image[image,image/jpg,image/jpeg,image/png]'], 'errors' => ['is_image' => 'Gambar tidak sesuai.']],
            ]);
        }else{
            $validation->setRules([
                'name' => ['name' => 'name', 'rules' => 'required', 'errors' => ['required' => 'Name field is required.']],
            ]);
        }
        $isValid = $validation->withRequest($this->request)->run();

        if($isValid){
            if(is_file($image)){
                $imageFile = $image->getRandomName();
                $image->move('uploads/media/media_sponsor', $imageFile);
                $media->set([
                    'name' => $this->request->getVar('name'),
                    'url' => $this->request->getVar('url'),
                    'media' => $imageFile
                ]);
            }else{
                $media->set([
                    'name' => $this->request->getVar('name'),
                    'url' => $this->request->getVar('url')
                ]);
            }
            $media->where('id_media_sponsor', trim($this->request->getVar('id')));
            $media->update();
        }else{
            $session->setFlashdata('error',true);
            $session->setFlashdata('name', $validation->getError('name'));
            $session->setFlashdata('url', $validation->getError('url'));
            $session->setFlashdata('image', $validation->getError('image'));
            return redirect()->back()->withInput();
        }

        return redirect()->back();
    }

    public function Delete($id){
        $media = new MedsponMod();
        $media->where('id_media_sponsor',$id);
        $media->delete();
        return redirect()->back();
    }

}