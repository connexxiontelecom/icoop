<?php 
namespace App\Controllers;
use App\Models\Applications;
use App\Models\Banks;
use App\Models\DepartmentModel;
use App\Models\PayrollGroups;
use App\Models\StateModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;


class Usercontroller extends BaseController
{
    public function __construct(){

        $this->state = new StateModel();
        $this->department = new DepartmentModel();
        $this->application = new Applications();
        $this->bank = new Banks();
        $this->pg = new PayrollGroups();
        $this->session = session();

    }
    
	public function index()
	{
        $this->session = session();
        $username = $this->session->user_username;
        $data = [];
	    $this->authenticate_user($username, 'layouts/master', $data);

	}

    
    #Authentication
    public function showLoginForm(){
        helper(['form']);
        $data['url'] = '';
        return view('auth/login', $data);
    }

    public function login(){
        $data = [];
        helper(['form']);
        if($this->request->getMethod() == 'post'){
            $rules = [
                'email'=> [
                    'rules'=>'required|valid_email',
                    'label'=>'Email address',
                    'errors'=>[
                        'required'=>'Email address field is compulsory',
                        'valid_email'=>'Kindly enter a valid email address'
                    ]
                ],
                'password'=> [
                    'rules'=>'required|min_length[8]',
                    'label'=>'Password',
                    'errors'=>[
                        'required'=>'Enter your registered password'
                        
                    ]
                ]
            ];
            if($this->validate($rules)){
                $session = session();
                $user = new UserModel;
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $url = $this->request->getVar('url');
                $data = $user->where('email', $email)->first();
                if($data){
                    $pass = $data['password'];
                    $verify_password = password_verify($password, $pass);
                    if($verify_password){
                        $ses_data = [
                            'user_id'=> $data['user_id'],
                            'user_email'=>$data['email'],
                            'user_username' => $data['email'],
                            'user_first_name'=>$data['first_name'],
                            'user_last_name' => $data['last_name']
                        ];
                        $session->set($ses_data);
                        if(!empty($url)):
	                        return  redirect()->to($url);
                        else:
                        return redirect()->to('/dashboard');
                        endif;
                    }else{
                    }
                    $session->setFlashdata('msg', 'Wrong password.');
                    return redirect()->to('/login');
                }
            }else{
                $data['validation'] = $this->validator;
                return view('auth/login',$data);
            }
        }
    }


    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function showRegistrationForm(){
        helper(['form']);
        return view('auth/register');
    }

    public function register(){
        $data = [];
        helper(['form']);
        if($_POST){
            $rules = [
                'email'=>[
                    'rules'=>'required|valid_email',
                    'label'=>'Email address',
                    'errors'=>[
                        'required'=>'Email address field is compulsory.',
                        'valid_email'=>'A valid email address is required'
                    ]
                ],
                'first_name'=>[
                    'rules'=>'required',
                    'label'=>'First name',
                    'errors'=>[
                        'required'=>'Kindly enter your first name'
                    ],
                ],
                'password'=>'required'

            ];  
            if($this->validate($rules)){
                $user = new UserModel;
                $data = [
                    'first_name'=> $this->request->getVar('first_name'),
                    'email'=> $this->request->getVar('email'),
                    'password'=>password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
                ];
                $user->save($data);
                return redirect()->to('/login');
            }else{
                $data['validation'] = $this->validator;
                return view('auth/register', $data);
            }          
        }
    }


    public function dashboard(){

        $username = $this->session->user_username;
        $data = [];
        $this->authenticate_user($username, 'pages/dashboard', $data);

    }

    public function error_404(){

        $username = $this->session->user_username;
        $data = [];
        $this->authenticate_user($username, 'auth/error_404', $data);
    }


}
