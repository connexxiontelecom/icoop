<?php


namespace App\Controllers;
use App\Models\Applications;
use App\Models\Banks;
use App\Models\PayrollGroups;
use App\Models\StateModel;
use App\Models\DepartmentModel;

class Cooperators extends BaseController
{
         public function __construct(){

             $this->state = new StateModel();
             $this->department = new DepartmentModel();
             $this->application = new Applications();
             $this->bank = new Banks();
             $this->pg = new PayrollGroups();
             $this->session = session();

        }

        public function new_application(){

            $method = $this->request->getMethod();
                    if($method == 'post'):

                        $v = $this->application->save($_POST);

                            if($v):

                                $data = array(
                                    'msg' => 'Application Successful',
                                    'type' => 'success',
                                    'location' => site_url('new_application')

                                );

                                return view('pages/sweet-alert', $data);

                            else:


                            endif;



                     else:

                        $data['states'] = $this->state->findAll();
                        $data['departments'] = $this->department->findAll();
                        $data['banks'] = $this->bank->findAll();
                        $data['pgs'] = $this->pg->findAll();
                        $username = $this->session->user_username;
                        $this->authenticate_user($username, 'pages/cooperators/new_application', $data);

                     endif;


        }

        public function verify_application(){

            $data['states'] = $this->state->findAll();
            $data['departments'] = $this->department->findAll();
            $data['banks'] = 'banks';
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/cooperators/verify_application', $data);

        }

        public function verify_application_($application_id){


        }


}
