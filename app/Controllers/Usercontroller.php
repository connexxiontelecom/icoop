<?php 
namespace App\Controllers;
use App\Models\UserModel; 

class Usercontroller extends BaseController
{
    
	public function index()
	{
		return view('layouts/master');
	}

    
    #Authentication
    public function showLoginForm(){
        helper(['form']);
        return view('auth/login');
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
                $data = $user->where('email', $email)->first();
                if($data){
                    $pass = $data['password'];
                    $verify_password = password_verify($password, $pass);
                    if($verify_password){
                        $ses_data = [
                            'user_id'=> $data['user_id'],
                            'user_email'=>$data['email'],
                            'user_first_name'=>$data['first_name']
                        ];
                        $session->set($ses_data);
                        return redirect()->to('/dashboard');
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
        return view('pages/dashboard');
    }
}
