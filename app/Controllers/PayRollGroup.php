<?php


namespace App\Controllers;
use App\Models\pgTypeModel;
use App\Models\PayrollGroups;
use App\Models\CoaModel;



class PayRollGroup extends BaseController
{

    public function __construct(){

        $this->pg = new PayrollGroups();
        $this->coa = new CoaModel();
        //$this->session = session();
    }

    public function payroll_group () {

        $method = $this->request->getMethod();
        if($method == 'post'):

            if($_POST['type'] == 1):

                $this->validator->setRules( [
                    'pg_name'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Enter a name'
                        ]
                    ],

                    'pg_gl_code'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Enter a GL Code'
                        ]
                    ],
                    

                ]);

                if ($this->validator->withRequest($this->request)->run()):



                    $check_pg = $this->pg->where('pg_name', $_POST['pg_name'])
                        ->findAll();



                    if($check_pg):
                        $data = array(
                            'msg' => 'pg type already exists',
                            'type' => 'error',
                            'location' => base_url('payroll_group')

                        );

                        echo view('pages/sweet-alert', $data);

                    else:

                        //                                print_r($_POST);
                        //
                        $v = $this->pg->save($_POST);

                        if($v):

                            $data = array(
                                'msg' => 'Action Successful',
                                'type' => 'success',
                                'location' => base_url('payroll_group')

                            );

                            return view('pages/sweet-alert', $data);

                        else:

                            $data = array(
                                'msg' => 'An error Occurred',
                                'type' => 'error',
                                'location' => base_url('payroll_group')

                            );

                            return view('pages/sweet-alert', $data);

                        endif;
                    endif;


                else:
                    $arr = $this->validator->getErrors();

                    $data = array(
                        'msg' => implode(", ", $arr),
                        'type' => 'error',
                        'location' => base_url('payroll_group')

                    );

                    echo view('pages/sweet-alert', $data);

                    //print_r($this->validator->getErrors());

                endif;

            endif;

            if($_POST['type'] == 2):


                $this->validator->setRules( [
                    'pg_name'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Enter a name'
                        ]
                    ],

                    'pg_gl_code'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'Enter a GL Code'
                        ]
                    ],


                ]);

                if ($this->validator->withRequest($this->request)->run()):



                    $check_pg = $this->pg->where('pg_name', $_POST['pg_name'])
                        ->findAll();

                $check_pg = 0;



                    if($check_pg):
                        $data = array(
                            'msg' => 'pg type already exists',
                            'type' => 'error',
                            'location' => base_url('payroll_group')

                        );

                        echo view('pages/sweet-alert', $data);

                    else:

                        $data = [
                            'pg_id' => $this->request->getVar('pg_id'),
                            'pg_name' => $this->request->getVar('pg_name'),
                            'pg_gl_code' => $this->request->getVar('pg_gl_code'),

                        ];

                        $v = $this->pg->save($data);

                        if($v):

                            $data = array(
                                'msg' => 'Action Successful',
                                'type' => 'success',
                                'location' => base_url('payroll_group')

                            );

                            return view('pages/sweet-alert', $data);

                        else:

                            $data = array(
                                'msg' => 'An Error Occurred',
                                'type' => 'error',
                                'location' => base_url('payroll_group')

                            );

                            return view('pages/sweet-alert', $data);
                        endif;
                    endif;


                else:
                    $arr = $this->validator->getErrors();

                    $data = array(
                        'msg' => implode(", ", $arr),
                        'type' => 'error',
                        'location' => base_url('payroll_group')

                    );

                    echo view('pages/sweet-alert', $data);

                    //print_r($this->validator->getErrors());

                endif;


            endif;


            if($_POST['type'] == 3):


                $v = $this->pg->delete($this->request->getVar('pg_id'));

                if($v):

                    $data = array(
                        'msg' => 'Action Successful',
                        'type' => 'success',
                        'location' => base_url('payroll_group')

                    );

                    return view('pages/sweet-alert', $data);

                else:

                    $data = array(
                        'msg' => 'An error occurred',
                        'type' => 'error',
                        'location' => base_url('payroll_group')

                    );

                    return view('pages/sweet-alert', $data);
                endif;

            endif;



        else:


            $data['pgs'] = $this->pg->findAll();
            $data['coas'] = $this->coa->where(['type' => 2])->findAll();
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/control-panel/payroll_group', $data);

        endif;

    }
}
