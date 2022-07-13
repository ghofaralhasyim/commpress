<?php namespace App\Controllers;

use App\Models\Admin_Mod;

class BackOfficeChat extends BaseController
{
    protected $session;
    
    function __construct()
    {
        helper('form','url');
        $this->session = \Config\Services::session();
    }
}