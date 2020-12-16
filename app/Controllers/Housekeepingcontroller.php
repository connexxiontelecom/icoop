<?php 
namespace App\Controllers;
use App\Models\StateModel; 
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
		//return view('pages/house-keeping/states', $data);
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
