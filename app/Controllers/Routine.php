<?php


namespace App\Controllers;
use App\Models\PayrollGroups;
use App\Models\ContributionTypeModel;
use DateTime;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Cooperators;
use App\Models\TempPaymentsModel;
Use App\Models\PaymentDetailsModel;
use App\Models\ExceptionModel;
use App\Models\InterestRoutineModel;
use App\Models\LoanModel;
use App\Models\LoanRepaymentModel;

class Routine extends BaseController
{

    public function __construct(){
        $this->pg = new PayrollGroups();
        $this->contribution_type = new ContributionTypeModel();
        $this->cooperator = new Cooperators();
        $this->temp_pd = new TempPaymentsModel();
        $this->pd = new PaymentDetailsModel();
        $this->exception = new ExceptionModel();
        $this->ir = new InterestRoutineModel();
        $this->loan = new LoanModel();
        $this->lr = new LoanRepaymentModel();

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
	
	public function interest_routine(){
		
		$method = $this->request->getMethod();
		if($method == 'get'):
			$data = [];
	        $username = $this->session->user_username;
			$this->authenticate_user($username, 'pages/routine/interest_routine_base', $data);
			
		endif;
		
		if($method == 'post'):
			$this->validator->setRules( [
				'ir_month'=>[
					'rules'=>'required',
					'errors'=>[
						'required'=>'Select a Month'
					]
				],
				
				'ir_year'=>[
					'rules'=>'required',
					'errors'=>[
						'required'=>'Select a year'
					]
				],
				
				
			]);
			
			if ($this->validator->withRequest($this->request)->run()):
			
			$month = $_POST['ir_month'];
			$year = $_POST['ir_year'];
			$date = $_POST['ir_date'];
				
				$check_ir = $this->ir->where(['ir_month' => $month, 'ir_year' => $year])->findAll();
				
				if(!empty($check_ir)):
					
					$data = array(
						'msg' => 'Interest Routine already ran for selected Month and Year',
						'type' => 'error',
						'location' => site_url('interest_routine')
					
					);
					
					return view('pages/sweet-alert', $data);
					
					else:
					
					$active_loans = $this->loan->get_interestable_loans($date);
					$ref_code = 'interest_'.time();
					
						foreach ($active_loans as $active_loan):
							
							//print_r($active_loan);
						
							if($active_loan->interest_method == 2):
								
								$loan_repayments = $this->lr->where(['lr_loan_id' => $active_loan->loan_id])->findAll();
							
								$total_cr = 0;
								$total_dr = 0;
								$cr = 0;
								$dr = 0;
								
								foreach ($loan_repayments as $loan_repayment):
									
									if($loan_repayment['lr_dctype'] == 1):
										$cr = $loan_repayment['lr_amount'];
										$total_cr = $total_cr + $cr;
									endif;
									
									if($loan_repayment['lr_dctype']  == 2):
										$dr = $loan_repayment['lr_amount'];
										$total_dr = $total_dr + $dr;
									endif;
								
								endforeach;
								
								$interest_rate = $active_loan->interest_rate/100;
								$amount = $active_loan->amount + ($total_dr - $total_cr);
								$interest_amount = $interest_rate * $amount;
								
								
								
							
							endif;
							
							if($active_loan->interest_method == 3):
							
								$interest_rate = $active_loan->interest_rate/100;
								$amount = $active_loan->amount;
								
								$interest_amount = $interest_rate * $amount;
								
								
							
							endif;
							
							$dateObj   = DateTime::createFromFormat('!m', $month);
							$monthName = $dateObj->format('F');
							
							
							$lr_array = array(
								'lr_loan_id' => $active_loan->loan_id,
								'lr_month' => $month,
								'lr_year' => $year,
								'lr_amount' => $interest_amount,
								'lr_narration' => 'Interest for on '.$active_loan->loan_description.' '.$monthName.', '.$year,
								'lr_dctype' => 2,
								'lr_ref' => $ref_code,
								'lr_mi' => 0,
								'lr_mpr' => 0,
								'lr_interest' => 1,
								'lr_date' => $date
								
								
							);
							
							$loan_details = $this->loan->where(['loan_id' => $active_loan->loan_id])->first();
							$loan_interest_amount = $loan_details['interest'] + $interest_amount;
							
							$loan_array = array('loan_id' => $active_loan->loan_id,
												'interest' => $loan_interest_amount,
								);
							
							$ir_array = array(
								'ir_month' => $month,
								'ir_year' => $year,
								'ir_date' => $date
							);
							
							$i = $this->loan->save($loan_array);

							$j = $this->lr->save($lr_array);

							$k = $this->ir->save($ir_array);
						
						if($i && $j && $k):
							
							$data = array(
								'msg' => 'Action Successful',
								'type' => 'success',
								'location' => site_url('interest_routine')
							
							);
							
							return view('pages/sweet-alert', $data);
							
							
							else:
								
								$data = array(
									'msg' => 'An Error Occured',
									'type' => 'error',
									'location' => site_url('interest_routine')
								
								);
								
								return view('pages/sweet-alert', $data);
								
								endif;
								
						endforeach;
					
					endif;
			
			else:
				$arr = $this->validator->getErrors();
				
				$data = array(
					'msg' => implode(", ", $arr),
					'type' => 'error',
					'location' => base_url('interest_routine')
				
				);
				
				echo view('pages/sweet-alert', $data);
			
			endif;
			
		
		endif;
	}
	
}
