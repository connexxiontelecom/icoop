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
             $this->cooperator = new \App\Models\Cooperators();
             $this->session = session();

        }

        public function new_application(){

            $method = $this->request->getMethod();
                    if($method == 'post'):

                        $this->validator->setRules( [
                            'application_staff_id'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a staff ID'
                                ]
                            ],

                            'application_first_name'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a first name'
                                ]
                            ],

                            'application_last_name'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a last name'
                                ]
                            ],

                            'application_email'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter an email'
                                ]
                            ],

                            'application_dob'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a Date of Birth'
                                ]
                            ],

                            'application_gender'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Select a gender'
                                ]
                            ],

                            'application_location_id'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Select a location'
                                ]
                            ],

                            'application_department_id'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Select a department'
                                ]
                            ],

                            'application_payroll_group_id'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Select a Payroll Group'
                                ]
                            ],

                            'application_address'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter an address'
                                ]
                            ],

                            'application_state_id'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Select a state'
                                ]
                            ],

                            'application_city'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a city'
                                ]
                            ],

                            'application_telephone'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a Phone Number'
                                ]
                            ],

                            'application_bank_id'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Select a bank'
                                ]
                            ],

                            'application_bank_branch'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter Bank Branch'
                                ]
                            ],

                            'application_account_number'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter account number'
                                ]
                            ],

                            'application_savings'=>[
                                'rules'=>'required',
                                'errors'=>[
                                    'required'=>'Enter a savings'
                                ]
                            ],

                        ]);

                        if ($this->validator->withRequest($this->request)->run()):

                            $check_staff_id = $this->application->where('application_staff_id', $_POST['application_staff_id'])
                                ->findAll();

                            $check_telephone = $this->application->where('application_telephone', $_POST['application_telephone'])
                                ->findAll();

                            $check_email = $this->application->where('application_email', $_POST['application_email'])
                                ->findAll();

                            if($check_email || $check_telephone || $check_staff_id):
                                $data = array(
                                    'msg' => 'Email, Staff ID, or Phone Number Already Exists',
                                    'type' => 'error',
                                    'location' => site_url('new_application')

                                );

                                echo view('pages/sweet-alert', $data);

                            else:

//                                print_r($_POST);
//
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
                             endif;

                        else:
                            $arr = $this->validator->getErrors();

                            $data = array(
                                'msg' => implode(", ", $arr),
                                'type' => 'error',
                                'location' => site_url('new_application')

                            );

                            echo view('pages/sweet-alert', $data);

                        //print_r($this->validator->getErrors());

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

           $data['applications'] = $this->application->get_pending_verification();

            $username = $this->session->user_username;
           // print_r($data['applications']);
           $this->authenticate_user($username, 'pages/cooperators/verify_application', $data);

        }

        public function verify_application_($application_id){

           $method = $this->request->getMethod();

            if($method == 'post'):

                $application_status = $this->request->getVar('application_status');
                $application_verify_comment = $this->request->getVar('application_verify_comment');
                $application_discarded_reason = $this->request->getVar('application_discarded_reason');

            if($application_status == 1):

                $data = [
                    'application_id' => $application_id,
                    'application_status' => $application_status,
                    'application_verify_comment'    => $application_verify_comment,
                    'application_verify_by' => $this->session->user_first_name." ".$this->session->user_last_name,
                    'application_verify_date' => date('Y-m-d')
                ];

                $query = $this->application->save($data);

                //$query = 1;

                if($query == true):

                    $data = array(
                        'msg' => 'Application Verified',
                        'type' => 'success',
                        'location' => site_url('verify_application')

                    );

                    return view('pages/sweet-alert', $data);

                else:
                    $data = array(
                        'msg' => 'An Error Occurred',
                        'type' => 'error',
                        'location' => site_url('verify_application')

                    );

                    return view('pages/sweet-alert', $data);

                endif;

              elseif($application_status == 3):

                  $data = [
                      'application_id' => $application_id,
                      'application_status' => $application_status,
                      'application_discard_reason'    => $application_discarded_reason,
                      'application_discarded_by' => $this->session->user_first_name." ".$this->session->user_last_name,
                      'application_discarded_date' => date('Y-m-d')
                  ];

                  $query = $this->application->update($application_id, $data);

                  //$query = 1;

                  if($query == true):

                      $data = array(
                          'msg' => 'Application Discarded',
                          'type' => 'success',
                          'location' => site_url('verify_application')

                      );

                      return view('pages/sweet-alert', $data);

                  else:
                      $data = array(
                          'msg' => 'An Error Occurred',
                          'type' => 'error',
                          'location' => site_url('verify_application')

                      );

                      return view('pages/sweet-alert', $data);

                  endif;

            endif;




            else:

                   $application =  $this->application->get_application( $application_id);

                       if(!empty($application)):

                           if($application->application_status == 0):

                              $data['application'] = $application;
                               $data['states'] = $this->state->findAll();
                               $data['departments'] = $this->department->findAll();
                               $data['banks'] = $this->bank->findAll();
                               $data['pgs'] = $this->pg->findAll();

                               $username = $this->session->user_username;

                               $this->authenticate_user($username, 'pages/cooperators/verify_application_', $data);

                           else:

                               return redirect('error_404');

                           endif;

                         else:

                             return redirect('error_404');

                         endif;
            endif;

         }

         public function approve_application(){


             $data['applications'] = $this->application->get_verified_applications();

             $username = $this->session->user_username;
             // print_r($data['applications']);
             $this->authenticate_user($username, 'pages/cooperators/approve_application', $data);
         }

         public function approve_application_($application_id){

             $method = $this->request->getMethod();

             if($method == 'post'):

                 $application_status = $this->request->getVar('application_status');
                 $application_approved_comment = $this->request->getVar('application_approved_comment');
                 $application_discarded_reason = $this->request->getVar('application_discarded_reason');

                 if($application_status == 2):

                     $data = [
                         'application_id' => $application_id,
                         'application_status' => $application_status,
                         'application_approved_comment'    => $application_approved_comment,
                         'application_approved_by' => $this->session->user_first_name." ".$this->session->user_last_name,
                         'application_approved_date' => date('Y-m-d')
                     ];

                 //print_r($data);

                    $query = $this->application->save($data);

                    $application = $this->application->where('application_id', $application_id)
                                                        ->first();

//                    $cooperator_array = array(
//
//                        'cooperator_application_id' => $application->application_id,
//                        'cooperator_staff_id' => $application->application_staff_id,
//                        'cooperator_last_name' => $application->application_last_name,
//                        'cooperator_other_name' => $application->applicaton_other_name,
//                        'cooperator_gender' => $application->application_gender,
//                        'cooperator_department_id' => $application->application_department_id,
//                        'cooperator_location_id' => $application->application_location_id,
//                        'cooperator_payroll_group_id' => $application->application_payroll_group_id,
//                        'cooperator_dob' => $application->application_dob,
//                        'cooperator_email' => $application->application_email,
//                        'cooperator_address' => $application->application_address,
//                        'cooperator_city' => $application->application_city,
//                        'cooperator_state_id' => $application->application_state_id,
//                        'cooperator_telephone' => $application->application_telephone,
//                        'cooperator_kin_fullname' => $application->application_kin_fullname,
//                        'cooperator_kin_address' => $application->application_kin_address,
//                        'cooperator_kin_email' => $application->application_kin_email,
//                        'cooperator_kin_phone' => $application->application_kin_phone,
//                        'cooperator_kin_relationship' => $application->application_kin_relationship,
//                        'cooperator_bank_id' => $application->application_bank_id,
//                        'cooperator_account_number' => $application->application_account_number,
//                        'cooperator_bank_branch' => $application->application_bank_branch,
//                        'cooperator_sort_code' => $application->application_sort_code,
//                        'cooperator_date' => $application->application_date,
//                        'cooperator_savings' => $application->application_savings,
//                        'cooperator_verify_by' => $application->application_verify_by,
//                        'cooperator_verify_date' => $application->application_verify_date,
//                        'cooperator_verify_comment' => $application->application_verify_comment,
//                        'cooperator_approved_by' => $application->application_approved_by,
//                        'cooperator_approved_date' => $application->application_approved_date,
//                        'cooperator_approved_comment' => $application->application_approved_comment,
//                        'cooperator_discarded_by' => $application->application_discarded_by,
//                        'cooperator_discarded_date' => $application->application_discared_date,
//                        'cooperator_discarded_reason' => $application->application_discarded_reason,
//                        'cooperator_status' => $application->application_status
//
//
//                    );

                     $cooperator_array = array(

                         'cooperator_application_id' => $application['application_id'],
                         'cooperator_staff_id' => $application['application_staff_id'],
                         'cooperator_username' => null,
                         'cooperator_password' => password_hash('password1234', PASSWORD_BCRYPT),
                         'cooperator_last_name' => $application['application_last_name'],
                         'cooperator_other_name' => $application['application_other_name'],
                         'cooperator_gender' => $application['application_gender'],
                         'cooperator_department_id' => $application['application_department_id'],
                         'cooperator_location_id' => $application['application_location_id'],
                         'cooperator_payroll_group_id' => $application['application_payroll_group_id'],
                         'cooperator_dob' => $application['application_dob'],
                         'cooperator_email' => $application['application_email'],
                         'cooperator_address' => $application['application_address'],
                         'cooperator_city' => $application['application_city'],
                         'cooperator_state_id' => $application['application_state_id'],
                         'cooperator_telephone' => $application['application_telephone'],
                         'cooperator_kin_fullname' => $application['application_kin_fullname'],
                         'cooperator_kin_address' => $application['application_kin_address'],
                         'cooperator_kin_email' => $application['application_kin_email'],
                         'cooperator_kin_phone' => $application['application_kin_phone'],
                         'cooperator_kin_relationship' => $application['application_kin_relationship'],
                         'cooperator_bank_id' => $application['application_bank_id'],
                         'cooperator_account_number' => $application['application_account_number'],
                         'cooperator_bank_branch' => $application['application_bank_branch'],
                         'cooperator_sort_code' => $application['application_sort_code'],
                         'cooperator_date' => $application['application_date'],
                         'cooperator_savings' => $application['application_savings'],
                         'cooperator_verify_by' => $application['application_verify_by'],
                         'cooperator_verify_date' => $application['application_verify_date'],
                         'cooperator_verify_comment' => $application['application_verify_comment'],
                         'cooperator_approved_by' => $application['application_approved_by'],
                         'cooperator_approved_date' => $application['application_approved_date'],
                         'cooperator_approved_comment' => $application['application_approved_comment'],
                         'cooperator_discarded_by' => $application['application_discarded_by'],
                         'cooperator_discarded_date' => $application['application_discarded_date'],
                         'cooperator_discarded_reason' => $application['application_discarded_reason'],
                         'cooperator_status' => $application['application_status']


                     );

                     $query = $this->cooperator->save($cooperator_array);
//                    print_r($cooperator_array);



                     //$query = 1;

                     if($query == true):

                         $data = array(
                             'msg' => 'Application Approved',
                             'type' => 'success',
                             'location' => site_url('approve_application')

                         );

                         return view('pages/sweet-alert', $data);

                     else:
                         $data = array(
                             'msg' => 'An Error Occurred',
                             'type' => 'error',
                             'location' => site_url('approve_application')

                         );

                         return view('pages/sweet-alert', $data);

                     endif;

                 elseif($application_status == 3):

                     $data = [
                         'application_id' => $application_id,
                         'application_status' => $application_status,
                         'application_discard_reason'    => $application_discarded_reason,
                         'application_discarded_by' => $this->session->user_first_name." ".$this->session->user_last_name,
                         'application_discarded_date' => date('Y-m-d')
                     ];

                 //print_r($data);

                    $query = $this->application->update($application_id, $data);

                     //$query = 1;

                     if($query == true):

                         $data = array(
                             'msg' => 'Application Discarded',
                             'type' => 'success',
                             'location' => site_url('verify_application')

                         );

                         return view('pages/sweet-alert', $data);

                     else:
                         $data = array(
                             'msg' => 'An Error Occurred',
                             'type' => 'error',
                             'location' => site_url('verify_application')

                         );

                         return view('pages/sweet-alert', $data);

                     endif;

                 endif;




             else:

                 $application =  $this->application->get_application( $application_id);

                 if(!empty($application)):

                     if($application->application_status == 1):

                         $data['application'] = $application;
                         $data['states'] = $this->state->findAll();
                         $data['departments'] = $this->department->findAll();
                         $data['banks'] = $this->bank->findAll();
                         $data['pgs'] = $this->pg->findAll();

                         $username = $this->session->user_username;

                         $this->authenticate_user($username, 'pages/cooperators/approve_application_', $data);

                     else:
                         return redirect('error_404');


                     endif;

                 else:

                     return redirect('error_404');

                 endif;
             endif;

         }



        public function test_sweet(){

            $data = array(
                'msg' => 'Application Successful',
                'type' => 'success',
                'location' => site_url('new_application')

            );

            return view('pages/sweet-alert', $data);

        }


}
