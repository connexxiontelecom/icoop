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
        $this->user = new UserModel();

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
    
    
    public function new_user(){
	    $method = $this->request->getMethod();
	
	    if($method == 'get'):
		        $username = $this->session->user_username;
			    $data = [];
			    $this->authenticate_user($username, 'auth/new_user', $data);
		endif;
	
	
	    if($method == 'post'):
		
		    $this->validator->setRules( [
			    'first_name'=>[
				    'rules'=>'required',
				    'errors'=>[
					    'required'=>'Enter first name '
				    ]
			    ],
			
			    'last_name'=>[
				    'rules'=>'required',
				    'errors'=>[
					    'required'=>'Enter last name'
				    ]
			    ],
			
			    'username'=>[
				    'rules'=>'required|min_length[4]',
				    'errors'=>[
					    'required'=>'Enter a username',
					    
				    ]
			    ],
			
			    'password'=>[
				    'rules'=>'required',
				    'errors'=>[
					    'required'=>'Enter a password'
				    ]
			    ],
		
		
		
		    ]);
		
		    if ($this->validator->withRequest($this->request)->run()):
				$_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);
		    
		    
		        $check_username = $this->user->where('username', $_POST['username'])->first();
		        if(!empty($_POST['email'])):
		         $check_email = $this->user->where('email', $_POST['email'])->first();
		        endif;
		        
		        if((empty($check_username)) && (empty($check_email))):
			      
			        $v = $this->user->save($_POST);
			        
			        if($v):
				        $data = array(
					        'msg' => 'User created successfully',
					        'type' => 'success',
					        'location' => base_url('new_user')
				
				        );
				
				        echo view('pages/sweet-alert', $data);
				        
				        
				        else:
					
					        $data = array(
						        'msg' => 'An error occurred',
						        'type' => 'error',
						        'location' => base_url('new_user')
					
					        );
					
					        echo view('pages/sweet-alert', $data);
					        endif;
				else:
					
					$data = array(
						'msg' => 'Email or username already taken',
						'type' => 'error',
						'location' => base_url('new_user')
					
					);
					
					echo view('pages/sweet-alert', $data);
				
				endif;
		
		    else:
			
			    $arr = $this->validator->getErrors();
			
			    $data = array(
				    'msg' => implode(", ", $arr),
				    'type' => 'error',
				    'location' => base_url('new_user')
			
			    );
			
			    echo view('pages/sweet-alert', $data);
		
		
		    endif;
			   
		    
		    
		    
		
	    endif;
    }
    
    public function check_user(){
    	$type = $_POST['type'];
    	if($type == 1):
	        $username = $_POST['user_name'];
	        $check = $this->user->where('username', $username)->first();
	        $data = [];
	        if(!empty($check)):
			    $data = $check;
			    endif;
	        echo json_encode($data);
        endif;
	
	    if($type == 2):
		    $email = $_POST['email'];
		    $data = [];
	    if(!empty($email)):
		    $check = $this->user->where('email', $email)->first();
		  
		    if(!empty($check)):
			    $data = $check;
		    endif;
		endif;
		    echo json_encode($data);
	    endif;
    	
    }

    public function error_404(){

        $username = $this->session->user_username;
        $data = [];
        $this->authenticate_user($username, 'auth/error_404', $data);
    }


}
