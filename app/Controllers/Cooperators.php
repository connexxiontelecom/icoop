<?php


namespace App\Controllers;
use App\Models\StateModel;
use App\Models\DepartmentModel;

class Cooperators extends BaseController
{
         public function __construct(){

             $this->state = new StateModel();
             $this->department = new DepartmentModel();
             $this->session = session();

        }

        public function new_application(){

            $method = $this->request->getMethod();
                    if($method == 'post'):

                        print_r($_POST);

                     else:

                        $data['states'] = $this->state->findAll();
                        $data['departments'] = $this->department->findAll();
                        $data['banks'] = 'banks';
                         $username = $this->session->user_username;
                        $this->authenticate_user($username, 'pages/cooperators/new_application', $data);

                     endif;


        }


}
