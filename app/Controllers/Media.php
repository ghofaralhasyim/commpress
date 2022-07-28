<?php namespace App\Controllers;

use App\Libraries\Breadcrumb;
use App\Models\MediaMod;
use CodeIgniter\I18n\Time;

class Media extends BaseController
{

    function __construct()
    {
		if (session()->get('role') != "media") {
            echo 'Access denied';
            exit;
        }
        helper('form','url');
        $this->session = \Config\Services::session();
        $this->breadcrumb = new Breadcrumb();
    }

    public function index(){
        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();
        return view('media/index',$data);
    }

    public function content(){
        $media = new MediaMod();
        $media->select('*');
        $media->join('member',"member.id_member = id_media");
        $media->where('id_media',session()->get('id'));
        $data['content'] = $media->get()->getFirstRow();

        $data['breadcrumbs'] = $this->breadcrumb->buildAuto();
        return view('media/page/content',$data);
    }

    public function SaveContent(){
        $media = new MediaMod();
        $id = $this->request->getVar('id_media');
        $media->select('id_content');
        $media->where('id_media',$id);
        $count = $media->countAllResults();

        var_dump($count);

        $session = session();

        if (!empty($_POST)) {
            $validation =  \Config\Services::validation();
            $type = trim($this->request->getVar('type'));

           if($type === 'image' && $count == 0){
                $validation->setRules([
                    'description' => ['description' => 'description', 'rules' => 'required|min_length[25]', 'errors' => ['required' => 'Caption is required.']],
                    'title' => ['title' => 'title', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Title is required.']],
                    'image' => ['image' => 'image', 'rules' => ['uploaded[image]','is_image[image,image/jpg,image/jpeg,image/png]'], 
                        'errors' => ['is_image' => 'Image format is not supported.','uploaded' => 'Image is required.']
                    ],
                    'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['is_image[thumbnail,image/jpg,image/jpeg,image/png]'], 
                        'errors' => ['is_image' => 'Image format is not supported.']
                    ],
                ]);
           }elseif($type === 'video' && $count == 0 ){
                $validation->setRules([
                    'description' => ['description' => 'description', 'rules' => 'required|min_length[25]', 'errors' => ['required' => 'Caption is required.']],
                    'title' => ['title' => 'title', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Title is required.']],
                    'url' => ['url' => 'url', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Video ID is required.']],
                    'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['is_image[thumbnail,image/jpg,image/jpeg,image/png]','uploaded[thumbnail]'], 
                        'errors' => ['is_image' => 'Image format is not supported.','uploaded' => 'Thumbnail image is required.']
                    ],
                ]);
           }elseif($type === 'image'){
                $validation->setRules([
                    'description' => ['description' => 'description', 'rules' => 'required|min_length[25]', 'errors' => ['required' => 'Caption is required.']],
                    'title' => ['title' => 'title', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Title is required.']],
                    'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['is_image[thumbnail,image/jpg,image/jpeg,image/png]'], 
                        'errors' => ['is_image' => 'Image format is not supported.']
                    ],
                    'image' => ['image' => 'image', 'rules' => ['is_image[image,image/jpg,image/jpeg,image/png]'], 
                        'errors' => ['is_image' => 'Image format is not supported.']
                    ],
                ]);
           }elseif($type === 'video'){
                $validation->setRules([
                    'description' => ['description' => 'description', 'rules' => 'required|min_length[25]', 'errors' => ['required' => 'Caption is required.']],
                    'title' => ['title' => 'title', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Title is required.']],
                    'url' => ['url' => 'url', 'rules' => 'required|min_length[5]', 'errors' => ['required' => 'Video ID is required.']],
                    'thumbnail' => ['thumbnail' => 'thumbnail', 'rules' => ['is_image[thumbnail,image/jpg,image/jpeg,image/png]'], 
                        'errors' => ['is_image' => 'Image format is not supported.']
                    ],
                ]);
           }

           $isValid = $validation->withRequest($this->request)->run();

            if($isValid && $count > 0){
                $thumbnail = $this->request->getFile('thumbnail');
                if(is_file($thumbnail)){
                    $thumbnailName = $thumbnail->getRandomName();
                    $thumbnail->move('uploads/media/medrel/thumbnail/', $thumbnailName);
                    $media->set('thumbnail', $thumbnailName);
                }
                $image = $this->request->getFile('image');
                if(is_file($image)){
                    $imageName = $image->getRandomName();
                    $image->move('uploads/media/medrel/content/', $imageName);
                    $media->set('image', $imageName);
                }
                $media->set('title', $this->request->getVar('title'));
                $media->set('url', $this->request->getVar('url'));
                $media->set('description', $this->request->getVar('description'));
                $media->set('status', $this->request->getVar('status'));
                $media->set('content_type', $this->request->getVar('type'));
                $media->where('id_media', "$id");
                $media->update();
                $session->setFlashdata('success', "Content has been updated!");
                return redirect()->back();
            }else if($isValid){
                $imageName = null;
                if($type === 'image'){
                    $image = $this->request->getFile('image');
                    if(is_file($image)){
                        $imageName = $image->getRandomName();
                        $image->move('uploads/media/medrel/content/', $imageName);
                    }
                }

                $thumbnail = $this->request->getFile('thumbnail');
                $thumbnailName = null;
                if(is_file($thumbnail)){
                    $thumbnailName = $thumbnail->getRandomName();
                    $thumbnail->move('uploads/media/medrel/thumbnail/', $thumbnailName);
                }

                $media->insert([
                    'title' => $this->request->getVar('title'),
                    'slug' => strtolower(preg_replace('/\s+/', '-', $this->request->getVar('title'))),
                    'id_media'=> $id,
                    'status' => $this->request->getVar('status'),
                    'description' => $this->request->getVar('description'),
                    'content_type' =>  $this->request->getVar('type'),
                    'url' =>  $this->request->getVar('url'),
                    'thumbnail' => $thumbnailName,
                    'created_at' => new Time('now'),
                    'image' => $imageName
                ]);

                return redirect()->to("dashboard-media/content");
            }else{
                $session->setFlashdata('description', $validation->getError('description'));
				$session->setFlashdata('title', $validation->getError('title'));
                $session->setFlashdata('thumbnail', $validation->getError('thumbnail'));
                if($this->request->getVar('type') === 'video'){
                    $session->setFlashdata('url', $validation->getError('url'));
                }elseif($this->request->getVar('type') === 'image'){
                    $session->setFlashdata('image', $validation->getError('image'));
                }

				return redirect()->back()->withInput();
            }
        }else{
            return redirect()->back();
        }
    }
}