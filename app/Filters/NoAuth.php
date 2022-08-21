<?php namespace App\Filters;
 
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
 
class Noauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('logged_in')) {

			if (session()->get('role') == "panitia") {
				return redirect()->to(base_url('dashboard'));
			}

			if (session()->get('role') == "peserta") {
				return redirect()->to(base_url('member'));
			}

            if (session()->get('role') == "media") {
				return redirect()->to(base_url('dashboard-media'));
			}

        }

    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}