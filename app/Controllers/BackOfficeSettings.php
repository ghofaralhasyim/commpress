<?php namespace App\Controllers;

use App\Models\WebSettings;
use CodeIgniter\I18n\Time;
use stdClass;

class BackOfficeSettings extends BaseController
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

	public function WebSettings(){
        $settings = new WebSettings();
        $settings->select('*');
        $results = $settings->get()->getResult();

        $data = array();
        foreach($results as $temp){
            $data[$temp->key_settings] = $temp;
        }
    
        return view('admin/page/webSettings',$data);
    }

    public function WebSettingsSave(){
        $validation =  \Config\Services::validation();
        $validation->setRules([
				'media' => [
                    'rules' => 'is_image[media,image/jpg,image/jpeg,image/gif,image/png,image/webp]|max_size[media,2048]',
                    'errors' => [
                        'mime_in' => 'Invalid file format. Supported file format: webp,jpg,jpeg,gif,png.',
                    ]
                ]
			]);
        $isValid = $validation->withRequest($this->request)->run();

        if (!$isValid) {
			$this->session->setFlashdata('error', $validation->listErrors());
			return redirect()->back()->withInput();
		}

        $settings = new WebSettings();
        $media = $this->request->getFile('media');
        if(is_file($media)){
            $fileName = $media->getRandomName();
            $media->move('uploads/media/web_settings/', $fileName);
        }else{
            $settings->select('*');
            $results = $settings->get()->getFirstRow();
            $fileName = $results->media;
        }
		$settings->set([
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
			'media' => $fileName,
            'updated_at' => new Time('now')
		]);
        $settings->where('key_settings','homepage_banner');
        $settings->update();
		session()->setFlashdata('success', 'Web settings updated');
		return redirect()->to(base_url('dashboard/web-settings'));
    }
}