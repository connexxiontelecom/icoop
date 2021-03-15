<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;
use CodeIgniter\RESTful\ResourceController;

class BaseController extends ResourceController
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = ['form', 'url'];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		$this->session = \Config\Services::session();
//        helper(['form']);

        $this->security = \Config\Services::security();
		$this->validator = \Config\Services::validation();
		$this->email = \Config\Services::email();
		$this->client = \Config\Services::curlrequest();


		
	}

    public function authenticate_user($username, $page, $data = null){
	   
	    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'):
		    $url = "https://";
	    else:
		    $url = "http://";
	    endif;
	    // Append the host(domain name, ip) to the URL.
	    $url.= $_SERVER['HTTP_HOST'];
	
	    // Append the requested resource location to the URL
	    $url.= $_SERVER['REQUEST_URI'];
	
	   
	   
	    
	  
	
	    //$this->response->redirect('login');
            if(isset($username)):
	           
                 echo view($page, $data);

            else:

                //$this->response->redirect('login', 'refresh');
           // $this->response->redirect()->to('login');
	        //return redirect()->to('login', 'refresh');
	            $data['url'] =  $url;
	            echo view('auth/login', $data);

            endif;

    }

}
