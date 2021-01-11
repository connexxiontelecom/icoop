<?php 
namespace App\Controllers;
use App\Models\Banks; 
use App\Models\StateModel; 
use App\Models\LocationModel; 
use App\Models\DepartmentModel;


class Housekeepingcontroller extends BaseController
{
    public function __construct(){

        $this->session = session();
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
    
}
