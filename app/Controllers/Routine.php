<?php


namespace App\Controllers;
use App\Models\PayrollGroups;
use App\Models\ContributionTypeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Cooperators;
use App\Models\TempPaymentsModel;
Use App\Models\PaymentDetailsModel;
use App\Models\ExceptionModel;

class Routine extends BaseController
{

    public function __construct(){
        $this->pg = new PayrollGroups();
        $this->contribution_type = new ContributionTypeModel();
        $this->cooperator = new Cooperators();
        $this->temp_pd = new TempPaymentsModel();
        $this->pd = new PaymentDetailsModel();
        $this->exception = new ExceptionModel();

    }

    public function upload_routine(){
        $data = [];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/routine/upload_routine_base', $data);
    }


    public function contribution_upload(){

        $temp_pds = $this->temp_pd->findAll();

        if(empty($temp_pds)):
            $data['pgs'] = $this->pg->findAll();
            $data['cts'] = $this->contribution_type->findAll();
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/routine/contribution_upload', $data);

        else:
            $temp_data = $this->temp_pd->first();
            $contribution_type_id = $temp_data['temp_pd_ct_id'];
            $payroll_group_id = $temp_data['temp_pd_pg_id'];
            $data['contribution_type'] = $this->contribution_type->where(['contribution_type_id' => $contribution_type_id])->first();
            $data['payroll_group'] = $this->pg->where(['pg_id'=> $payroll_group_id])->first();
            $data['temp_pds'] = $this->temp_pd->findAll();
            $data['permission'] = 1;
            return view('pages/routine/view_contribution_upload', $data);
       endif;

    }

    public function process_contribution_upload(){

        $this->validator->setRules( [
            'contribution_upload_pg'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Select a Payroll Group'
                ]
            ],

            'contribution_upload_ct'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Select a Contribution Type'
                ]
            ],

            'contribution_upload_date'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Enter a Date'
                ]
            ],

            'contribution_upload_narration'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Enter a Narration'
                ]
            ],

        ]);

        if ($this->validator->withRequest($this->request)->run()):
            $this->temp_pd->delete_temp();
            $contribution_type_id = $_POST['contribution_upload_ct'];
            $payroll_group_id = $_POST['contribution_upload_pg'];
            $date = $_POST['contribution_upload_date'];
            $narration = $_POST['contribution_upload_narration'];
            $ref_code = time();

           if($_FILES["select_excel"]["name"] != ''):
            $allowed_extension = array('xls', 'xlsx');
            $file_array = explode(".", $_FILES['select_excel']['name']);
            $file_extension = end($file_array);
            if(in_array($file_extension, $allowed_extension)):

                $reader = IOFactory::createReader('Xlsx');
                $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                //0 IS STAFF_id
                //1 is name
                // 2 is amount
                // do not forget
               unset($rows[0]);
                //echo '<br>';
                foreach ($rows as $row):
                    $staff_id = $row[0];
                    $amount = $row[2];

                    $cooperator_details = $this->cooperator->get_cooperator_staff_id($staff_id);

                    // 1 == non existent cooperator
                    // 2 == wrong Paygroup
                    // 3 == valid entry
                    if(empty($cooperator_details)):

                      $payment_details_array = array(
                         'temp_pd_staff_id' => $staff_id,
                          'temp_pd_transaction_date' => $date,
                          'temp_pd_narration' => $narration,
                          'temp_pd_amount' => $amount,
                          'temp_pd_drcrtype' => 1,
                          'temp_pd_ct_id' => $contribution_type_id,
                          'temp_pd_pg_id' => $payroll_group_id,
                          'temp_pd_ref_code' => $ref_code,
                          'temp_pd_status' => 1
                      );

                        else:

                           $cooperator_pg =  $cooperator_details->cooperator_payroll_group_id;

                   // $payment_details_array = $cooperator_details;


                        if($cooperator_pg != $payroll_group_id):

                                $payment_details_array = array(
                                    'temp_pd_staff_id' => $staff_id,
                                    'temp_pd_transaction_date' => $date,
                                    'temp_pd_narration' => $narration,
                                    'temp_pd_amount' => $amount,
                                    'temp_pd_drcrtype' => 1,
                                    'temp_pd_ct_id' => $contribution_type_id,
                                    'temp_pd_pg_id' => $payroll_group_id,
                                    'temp_pd_ref_code' => $ref_code,
                                    'temp_pd_status' => 2
                                );

                           else:

                                $payment_details_array = array(
                                    'temp_pd_staff_id' => $staff_id,
                                    'temp_pd_transaction_date' => $date,
                                    'temp_pd_narration' => $narration,
                                    'temp_pd_amount' => $amount,
                                    'temp_pd_drcrtype' => 1,
                                    'temp_pd_ct_id' => $contribution_type_id,
                                    'temp_pd_pg_id' => $payroll_group_id,
                                    'temp_pd_ref_code' => $ref_code,
                                    'temp_pd_status' => 3
                                );


                            endif;


                         endif;


                    $v = $this->temp_pd->save($payment_details_array);

//                    print_r($payment_details_array);
//                    echo '<br>';

                endforeach;



                if($v):
                    $data['contribution_type'] = $this->contribution_type->where(['contribution_type_id' => $contribution_type_id])->first();
                    $data['payroll_group'] = $this->pg->where(['pg_id'=> $payroll_group_id])->first();
                    $data['temp_pds'] = $this->temp_pd->findAll();
                    $data['permission'] = 1;



                    return view('pages/routine/view_contribution_upload', $data);

                else:

                    $data = array(
                        'msg' => 'An error Occurred',
                        'type' => 'error',
                        'location' => base_url('contribution_upload')

                    );

                    return view('pages/sweet-alert', $data);

                endif;

            else:

                $data = array(
                    'msg' => 'Only .xlsx, .xls, .csv extensions are allowed',
                    'type' => 'error',
                    'location' => base_url('contribution_upload')

                );

                return view('pages/sweet-alert', $data);
           endif;

        else:

            $data = array(
                'msg' => 'Please Select a File.',
                'type' => 'error',
                'location' => base_url('contribution_upload')

            );

            return view('pages/sweet-alert', $data);
        endif;

        else:

            $arr = $this->validator->getErrors();

            $data = array(
                'msg' => implode(", ", $arr),
                'type' => 'error',
                'location' => base_url('contribution_upload')

            );

            echo view('pages/sweet-alert', $data);

            endif;




    }

    public  function p_contribution_upload(){
        $temp_payments = $this->temp_pd->where(['temp_pd_status' => 1])->findAll();
        foreach ($temp_payments as $temp_payment):

            $exception_array = array(
               'exception_staff_id' => $temp_payment['temp_pd_staff_id'],
                'exception_transaction_date' => $temp_payment['temp_pd_transaction_date'],
                'exception_amount' => $temp_payment['temp_pd_amount'],
                 'exception_ref_code' => $temp_payment['temp_pd_ref_code']
            );

           $v =  $this->exception->save($exception_array);

            endforeach;

        $temp_payments = $this->temp_pd->where(['temp_pd_status' => 3])->findAll();
        foreach ($temp_payments as $temp_payment):

            $payment_details_array = array(
                'pd_staff_id' => $temp_payment['temp_pd_staff_id'],
                'pd_transaction_date' => $temp_payment['temp_pd_transaction_date'],
                'pd_narration' => $temp_payment['temp_pd_narration'],
                'pd_amount' => $temp_payment['temp_pd_amount'],
                'pd_drcrtype' => 1,
                'pd_ct_id' => $temp_payment['temp_pd_ct_id'],
                'pd_pg_id' => $temp_payment['temp_pd_pg_id'],
                'pd_ref_code' => $temp_payment['temp_pd_ref_code'],
                );


          $v =   $this->pd->save($payment_details_array);

        endforeach;

        if($v):
            $this->temp_pd->delete_temp();
            $data = array(
                'msg' => 'Action Successful',
                'type' => 'success',
                'location' => site_url('contribution_upload')

            );

            return view('pages/sweet-alert', $data);

        else:

            $data = array(
                'msg' => 'An error Occurred',
                'type' => 'error',
                'location' => site_url('contribution_upload')

            );

            return view('pages/sweet-alert', $data);

        endif;
    }
}
