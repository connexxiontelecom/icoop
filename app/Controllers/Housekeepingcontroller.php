<?php 
namespace App\Controllers;
use App\Models\Banks; 
use App\Models\CoaModel; 
use App\Models\StateModel; 
use App\Models\LocationModel; 
use App\Models\DepartmentModel;
use App\Models\CoopBankModel;


class Housekeepingcontroller extends BaseController
{
    public function __construct(){

        $this->session = session();
        $this->coopbanks = new CoopBankModel;
        $this->coas = new CoaModel;
        $this->banks = new Banks;
    }

	public function states()
	{
        $data = [];
        $states = new StateModel();
        $data['states'] = $states->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/house-keeping/states', $data);
	}


    public function addNewState(){
        helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'state_name'=>[
                    'rules'=>'required',
                    'label'=>'State name',
                    'errors'=>[
                        'required'=>'Enter a unique state name'
                    ]
                ]
            ];
            if($this->validate($rules)){
                $state = new StateModel;
                $data = [
                    'state_name'=>$this->request->getVar('state_name')
                ];
                $state->save($data);
                

            }else{
              $data['validation'] = $this->validator;
              return view('pages/house-keeping/states', $data);  
            }
        }
    }

    public function locations()
	{
        $data = [];
        $locations = new LocationModel();
        $data['locations'] = $locations->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/house-keeping/locations', $data);
    }
    
    public function addNewLocation(){
        helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'location_name'=>[
                    'rules'=>'required',
                    'label'=>'Location name',
                    'errors'=>[
                        'required'=>'Enter a unique location name'
                    ]
                ]
            ];
            if($this->validate($rules)){
                $location = new LocationModel;
                $data = [
                    'location_name'=>$this->request->getVar('location_name')
                ];
                $location->save($data);
                

            }else{
              $data['validation'] = $this->validator;
              return view('pages/house-keeping/locations', $data);  
            }
        }
    }
    public function editLocation(){
        helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'location_name'=>[
                    'rules'=>'required',
                    'label'=>'Location name',
                    'errors'=>[
                        'required'=>'Enter a unique location name'
                    ]
                ]
            ];
            if($this->validate($rules)){
                $location = new LocationModel;
                $data = [
                    'location_name'=>$this->request->getVar('location_name'),
                    'location_id'=>$this->request->getVar('locationId'),
                ];
                $location->update($this->request->getVar('locationId'), $data);
                

            }else{
              $data['validation'] = $this->validator;
              return view('pages/house-keeping/locations', $data);  
            }
        }
    }

    public function banks(){
        $data = [];
        $banks = new Banks;
        $data['banks'] = $banks->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/house-keeping/banks', $data);
    }

    public function addNewBank(){
        $data = [];
        helper(['form']);
        if($_POST){
            $rules = [
                'bank_name'=>[
                    'rules'=>'required',
                    'label'=>'Bank name',
                    'errors'=>[
                        'required'=>'Enter a unique bank name'
                    ]
                    ],
                'sort_code'=>[
                    'rules'=>'required',
                    'label'=>'Sort Code',
                    'errors'=>[
                        'required'=>'Enter a unique sort code'
                    ]
                    ],
                ];
                if($this->validate($rules)){
                    $bank = new Banks;
                    $data = [
                        'bank_name'=>$this->request->getVar('bank_name'),
                        'sort_code'=>$this->request->getVar('sort_code'),
                    ];
                    $bank->save($data);
                    

                }else{
                $data['validation'] = $this->validator;
                return view('pages/house-keeping/banks', $data);  
                }
            
        }
    }

    public function departments(){
        $data = [];
        $departments = new DepartmentModel;
        $data['departments'] = $departments->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/house-keeping/departments', $data);

    }


    public function addNewDepartment(){
        helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'department_name'=>[
                    'rules'=>'required',
                    'label'=>'Department name',
                    'errors'=>[
                        'required'=>'Enter a unique department name'
                    ]
                ]
            ];
            if($this->validate($rules)){
                $department = new DepartmentModel;
                $data = [
                    'department_name'=>$this->request->getVar('department_name')
                ];
                $department->save($data);
                

            }else{
              $data['validation'] = $this->validator;
              return view('pages/house-keeping/departments', $data);  
            }
        }
    }

    public function coopBanks(){
        $data = [];

        $data['coopbanks'] = $this->coopbanks->getCoopBanks();
        $data['banks'] = $this->banks->findAll();
        $data['coas'] = $this->coas->where('type',1)->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/house-keeping/coop-banks', $data);

    }
    
    public function addNewCoopBank(){
        helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'account_no'=>[
                    'rules'=>'required',
                    'label'=>'Account No.',
                    'errors'=>[
                        'required'=>'Account number is required.'
                    ]
                    ],
                'branch'=>[
                    'rules'=>'required',
                    'label'=>'Branch',
                    'errors'=>[
                        'required'=>'Branch is required.'
                    ]
                    ],
                'description'=>[
                    'rules'=>'required',
                    'label'=>'Description',
                    'errors'=>[
                        'required'=>'Description is required.'
                    ]
                    ],
                'gl_account'=>[
                    'rules'=>'required',
                    'label'=>'GL account',
                    'errors'=>[
                        'required'=>'GL account is required.'
                    ]
                    ],
                'bank'=>[
                    'rules'=>'required',
                    'label'=>'Bank',
                    'errors'=>[
                        'required'=>'Bank is required.'
                    ]
                    ],
            ];
            if($this->validate($rules)){
                $coop = new CoopBankModel;
                $data = [
                    'account_no'=>$this->request->getVar('account_no'),
                    'branch'=>$this->request->getVar('branch'),
                    'description'=>$this->request->getVar('description'),
                    'glcode'=>$this->request->getVar('gl_account'),
                    'bank_id'=>$this->request->getVar('bank')
                ];
                $coop->save($data);
                $this->coopBanks();
                
            }else{
              $data['validation'] = $this->validator;
              return view('pages/house-keeping/departments', $data);  
            }
        }
    }
    public function editCoopBank(){
        helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'account_no'=>[
                    'rules'=>'required',
                    'label'=>'Account No.',
                    'errors'=>[
                        'required'=>'Account number is required.'
                    ]
                    ],
                'branch'=>[
                    'rules'=>'required',
                    'label'=>'Branch',
                    'errors'=>[
                        'required'=>'Branch is required.'
                    ]
                    ],
                'description'=>[
                    'rules'=>'required',
                    'label'=>'Description',
                    'errors'=>[
                        'required'=>'Description is required.'
                    ]
                    ],
                'gl_account'=>[
                    'rules'=>'required',
                    'label'=>'GL account',
                    'errors'=>[
                        'required'=>'GL account is required.'
                    ]
                    ],
                'bank'=>[
                    'rules'=>'required',
                    'label'=>'Bank',
                    'errors'=>[
                        'required'=>'Bank is required.'
                    ]
                    ],
            ];
            if($this->validate($rules)){
                $data = [
                    'coop_bank_id'=>$this->request->getVar('editCoop'),
                    'account_no'=>$this->request->getVar('account_no'),
                    'branch'=>$this->request->getVar('branch'),
                    'description'=>$this->request->getVar('description'),
                    'glcode'=>$this->request->getVar('gl_account'),
                    'bank_id'=>$this->request->getVar('bank')
                ];
                $this->coopbanks->save($data);
                $alert = array(
                    'msg' => 'Success! Changes saved.',
                    'type' => 'success',
                    'location' => site_url('/coop-banks')

                );
                return view('pages/sweet-alert', $alert);
                
            }else{
              $data['validation'] = $this->validator;
              return view('pages/house-keeping/departments', $data);  
            }
        }
    }
}
