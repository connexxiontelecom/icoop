<?php


namespace App\Controllers;


use App\Models\ContributionTypeModel;

class ContributionType extends BaseController
{

    public function __construct(){

        $this->contribution_type = new ContributionTypeModel();
        //$this->session = session();
    }
    public function contribution_type () {

        $method = $this->request->getMethod();
        if($method == 'post'):

            if($_POST['type'] == 1):

                    $this->validator->setRules( [
                        'contribution_type_name'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'Enter a name'
                            ]
                        ]

                    ]);

                    if ($this->validator->withRequest($this->request)->run()):



                            $check_contribution = $this->contribution_type->where('contribution_type_name', $_POST['contribution_type_name'])
                                ->findAll();



                            if($check_contribution):
                                $data = array(
                                    'msg' => 'Contribution type already exists',
                                    'type' => 'error',
                                    'location' => site_url('new_application')

                                );

                                echo view('pages/sweet-alert', $data);

                            else:

            //                                print_r($_POST);
            //
                                $v = $this->contribution_type->save($_POST);

                                if($v):

                                    $data = array(
                                        'msg' => 'Action Successful',
                                        'type' => 'success',
                                        'location' => site_url('contribution_type')

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
                            'location' => site_url('contribution_type')

                        );

                        echo view('pages/sweet-alert', $data);

                        //print_r($this->validator->getErrors());

                    endif;

             endif;

             if($_POST['type'] == 2):


                 $this->validator->setRules( [
                     'contribution_type_name'=>[
                         'rules'=>'required',
                         'errors'=>[
                             'required'=>'Enter a name'
                         ]
                     ]

                 ]);

                 if ($this->validator->withRequest($this->request)->run()):



                     $check_contribution = $this->contribution_type->where('contribution_type_name', $_POST['contribution_type_name'])
                         ->findAll();



                     if($check_contribution):
                         $data = array(
                             'msg' => 'Contribution type already exists',
                             'type' => 'error',
                             'location' => site_url('contribution_type')

                         );

                         echo view('pages/sweet-alert', $data);

                     else:

                         $data = [
                             'contribution_type_id' => $this->request->getVar('contribution_type_id'),
                             'contribution_type_name' => $this->request->getVar('contribution_type_name')

                         ];

                         $v = $this->contribution_type->save($data);

                         if($v):

                             $data = array(
                                 'msg' => 'Action Successful',
                                 'type' => 'success',
                                 'location' => site_url('contribution_type')

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
                         'location' => site_url('contribution_type')

                     );

                     echo view('pages/sweet-alert', $data);

                     //print_r($this->validator->getErrors());

                 endif;


             endif;


            if($_POST['type'] == 3):


                        $v = $this->contribution_type->delete($this->request->getVar('contribution_type_id'));

                        if($v):

                            $data = array(
                                'msg' => 'Action Successful',
                                'type' => 'success',
                                'location' => site_url('contribution_type')

                            );

                            return view('pages/sweet-alert', $data);

                        else:


                        endif;

            endif;



        else:


            $data['contribution_types'] = $this->contribution_type->findAll();
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/control-panel/contribution_type', $data);

        endif;

    }
}
