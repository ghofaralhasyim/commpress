<?php namespace App\Controllers;

class Page extends BaseController
{
	public function Homepage()
	{
		return view('publics/homepage/landing');
	}

	public function Login()
	{
		return view('admin/login');
	}
}