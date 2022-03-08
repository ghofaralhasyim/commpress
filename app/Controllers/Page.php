<?php namespace App\Controllers;

class Page extends BaseController
{
	public function Oprec()
	{
		return view('publics/oprec/oprec');
	}

	public function Login()
	{
		return view('admin/login');
	}
}