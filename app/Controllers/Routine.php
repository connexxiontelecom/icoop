<?php


namespace App\Controllers;
use App\Models\GlModel;
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
use App\Models\LoanExceptionModel;
use App\Models\TempLoanRepaymentModel;
use App\Models\LoanSetupModel;
use App\Models\CoaModel;



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
        $this->le = new LoanExceptionModel();
        $this->temp_lr = new TempLoanRepaymentModel();
        $this->ls = new LoanSetupModel();
	    $this->gl = new GlModel();
	    $this->coa = new CoaModel();

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
            $month = $_POST['contribution_upload_month'];
            $year = $_POST['contribution_upload_year'];
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
                    $staff_name = $row[1];

                    $amount = $row[2];

                    $cooperator_details = $this->cooperator->get_cooperator_staff_id($staff_id);

                    // 1 == non existent cooperator
                    // 2 == wrong Paygroup
                    // 3 == valid entry
                    if(empty($cooperator_details)):

                      $payment_details_array = array(
                         'temp_pd_staff_id' => $staff_id,
                          'temp_pd_staff_name' => $staff_name,
                          'temp_pd_transaction_date' => $date,
                          'temp_pd_narration' => $narration,
                          'temp_pd_amount' => $amount,
                          'temp_pd_drcrtype' => 1,
                          'temp_pd_ct_id' => $contribution_type_id,
                          'temp_pd_pg_id' => $payroll_group_id,
                          'temp_pd_ref_code' => $ref_code,
                          'temp_pd_status' => 1,
	                      'temp_pd_month' => $month,
	                      'temp_pd_year' => $year
                      );

                        else:

                           $cooperator_pg =  $cooperator_details->cooperator_payroll_group_id;

                   // $payment_details_array = $cooperator_details;


                        if($cooperator_pg != $payroll_group_id):

                                $payment_details_array = array(
                                    'temp_pd_staff_id' => $staff_id,
	                                'temp_pd_staff_name' => $staff_name,
                                    'temp_pd_transaction_date' => $date,
                                    'temp_pd_narration' => $narration,
                                    'temp_pd_amount' => $amount,
                                    'temp_pd_drcrtype' => 1,
                                    'temp_pd_ct_id' => $contribution_type_id,
                                    'temp_pd_pg_id' => $payroll_group_id,
                                    'temp_pd_ref_code' => $ref_code,
                                    'temp_pd_status' => 2,
	                                'temp_pd_month' => $month,
	                                'temp_pd_year' => $year
                                );

                           else:

                                $payment_details_array = array(
                                    'temp_pd_staff_id' => $staff_id,
	                                'temp_pd_staff_name' => $staff_name,
                                    'temp_pd_transaction_date' => $date,
                                    'temp_pd_narration' => $narration,
                                    'temp_pd_amount' => $amount,
                                    'temp_pd_drcrtype' => 1,
                                    'temp_pd_ct_id' => $contribution_type_id,
                                    'temp_pd_pg_id' => $payroll_group_id,
                                    'temp_pd_ref_code' => $ref_code,
                                    'temp_pd_status' => 3,
	                                'temp_pd_month' => $month,
	                                'temp_pd_year' => $year
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
    
	public function cancel_ct_upload(){
		
	$referrer = $this->request->getUserAgent()->getReferrer();
	
	if($referrer == base_url('contribution_upload')):
		
		$this->temp_pd->delete_temp();
		$data = array(
			'msg' => 'Action Successful',
			'type' => 'success',
			'location' => site_url('contribution_upload')
		
		);
		
		return view('pages/sweet-alert', $data);
		
		else:
			$data = array(
				'msg' => 'An Error Occurred',
				'type' => 'error',
				'location' => site_url()
			
			);
			
			return view('pages/sweet-alert', $data);
			
			
				
				endif;
	}
    
    public  function p_contribution_upload(){
        $temp_payments = $this->temp_pd->where(['temp_pd_status' => 1])->findAll();
        
        foreach ($temp_payments as $temp_payment):

            $exception_array = array(
               'exception_staff_id' => $temp_payment['temp_pd_staff_id'],
                'exception_staff_name' => $temp_payment['temp_pd_staff_name'],
                'exception_transaction_date' => $temp_payment['temp_pd_transaction_date'],
                'exception_amount' => $temp_payment['temp_pd_amount'],
                 'exception_ref_code' => $temp_payment['temp_pd_ref_code'],
	            'exception_reason' => 'Member does not exist',
	            'exception_month' => $temp_payment['temp_pd_month'],
	            'exception_year' => $temp_payment['temp_pd_year']
            );

           $v =  $this->exception->save($exception_array);
	        
//	        print_r($exception_array);
//	        echo '<br>';

            endforeach;

        $temp_payments = $this->temp_pd->where(['temp_pd_status' => 3])->findAll();
        foreach ($temp_payments as $temp_payment):
	        ## check for duplicate upload
	
	        $check_duplicate = $this->pd->where(['pd_staff_id' => $temp_payment['temp_pd_staff_id'], 'pd_ct_id' => $temp_payment['temp_pd_ct_id'], 'pd_pg_id' => $temp_payment['temp_pd_pg_id'], 'pd_month' => $temp_payment['temp_pd_month'],
		        'pd_year' => $temp_payment['temp_pd_year'],  'pd_drcrtype' => 1 ])->findAll();
	
	        if(empty($check_duplicate)):
	
	            $payment_details_array = array(
	                'pd_staff_id' => $temp_payment['temp_pd_staff_id'],
	                'pd_transaction_date' => $temp_payment['temp_pd_transaction_date'],
	                'pd_narration' => $temp_payment['temp_pd_narration'],
	                'pd_amount' => $temp_payment['temp_pd_amount'],
	                'pd_drcrtype' => 1,
	                'pd_ct_id' => $temp_payment['temp_pd_ct_id'],
	                'pd_pg_id' => $temp_payment['temp_pd_pg_id'],
	                'pd_ref_code' => $temp_payment['temp_pd_ref_code'],
		            'pd_month' => $temp_payment['temp_pd_month'],
		            'pd_year' => $temp_payment['temp_pd_year']
	                );
	
	
	            $v =   $this->pd->save($payment_details_array);
		       
		        $wt = $this->contribution_type->where('contribution_type_id', $temp_payment['temp_pd_ct_id'])->first();
		        $account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();
		        
		        $bankGl = array(
			        'glcode' => $wt['contribution_type_glcode'],
			        'posted_by' => $this->session->user_username,
			        'narration' => $temp_payment['temp_pd_narration'],
			        'dr_amount' => 0,
			        'cr_amount' => $temp_payment['temp_pd_amount'],
			        'ref_no' =>$temp_payment['temp_pd_ref_code'],
			        'bank' => $account['bank'],
			        'ob' => 0,
			        'posted' => 1,
			        'created_at' =>  date('Y-m-d'),
		        );
		        $this->gl->save($bankGl);
		
				//debit payroll
		        //$wt = $this->ct->where('contribution_type_id', $temp_payment['temp_pd_ct_id'])->first();
		        $account = $this->coa->where('glcode', $wt['payroll_code'])->first();
		
		        $bankGl = array(
			        'glcode' => $wt['payroll_code'],
			        'posted_by' => $this->session->user_username,
			        'narration' => $temp_payment['temp_pd_narration'],
			        'dr_amount' => $temp_payment['temp_pd_amount'],
			        'cr_amount' => 0,
			        'ref_no' =>$temp_payment['temp_pd_ref_code'],
			        'bank' => $account['bank'],
			        'ob' => 0,
			        'posted' => 1,
			        'created_at' =>  date('Y-m-d'),
		        );
		        $this->gl->save($bankGl);
		       
	
	        else:
		
		        $v = 1;
	
	        endif;

        endforeach;
	
	
	    $temp_payments = $this->temp_pd->where(['temp_pd_status' => 2])->findAll();
	    foreach ($temp_payments as $temp_payment):
		    
		    ## check for duplicate upload
		    
		    $check_duplicate = $this->pd->where(['pd_staff_id' => $temp_payment['temp_pd_staff_id'], 'pd_ct_id' => $temp_payment['temp_pd_ct_id'], 'pd_pg_id' => $temp_payment['temp_pd_pg_id'], 'pd_month' => $temp_payment['temp_pd_month'],
			    'pd_year' => $temp_payment['temp_pd_year'],  'pd_drcrtype' => 1 ])->findAll();
	    
	    if(empty($check_duplicate)):
		
		    $payment_details_array = array(
			    'pd_staff_id' => $temp_payment['temp_pd_staff_id'],
			    'pd_transaction_date' => $temp_payment['temp_pd_transaction_date'],
			    'pd_narration' => $temp_payment['temp_pd_narration'],
			    'pd_amount' => $temp_payment['temp_pd_amount'],
			    'pd_drcrtype' => 1,
			    'pd_ct_id' => $temp_payment['temp_pd_ct_id'],
			    'pd_pg_id' => $temp_payment['temp_pd_pg_id'],
			    'pd_ref_code' => $temp_payment['temp_pd_ref_code'],
			    'pd_month' => $temp_payment['temp_pd_month'],
			    'pd_year' => $temp_payment['temp_pd_year']
		    );
		
		
		    $v =   $this->pd->save($payment_details_array);
		  
		    
		   else:
			  
			  $v = 1;
			  
			  endif;
	
	    endforeach;
	    
	    $v = 1;

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
					$interest_amount =0;
					//print_r($active_loans);
					
					if(!empty($active_loans)):
						foreach ($active_loans as $active_loan):
							
						
						
							if($active_loan->interest_method == 2):
								
								$loan_repayments = $this->lr->where(['lr_loan_id' => $active_loan->loan_id])->findAll();
							
								if(!empty($loan_repayment)):
							
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
										
										$interest_rate = $active_loan->ls_interest_rate/100;
										$amount = $active_loan->amount + ($total_dr - $total_cr);
										$interest_amount = $interest_rate * $amount;
								else:
									
									$interest_rate = $active_loan->ls_interest_rate/100;
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
									'lr_narration' => 'Interest Due for '.$monthName.', '.$year. 'for '.$active_loan->loan_description,
									'lr_dctype' => 2,
									'lr_ref' => $ref_code,
									'lr_mi' => 0,
									'lr_mpr' => 0,
									'lr_interest' => 1,
									'lr_interest_rate' => $active_loan->ls_interest_rate,
									'lr_date' => $date
								
								
								);
								$j = $this->lr->save($lr_array);
								
								//debit loan account
								$account = $this->coa->where('glcode', $active_loan->loan_gl_account_no)->first();
								$bankGl = array(
									'glcode' => $active_loan->loan_gl_account_no,
									'posted_by' => $this->session->user_username,
									'narration' => 'Interest Due for '.$monthName.', '.$year. 'for '.$active_loan->loan_description,
									'dr_amount' => $interest_amount,
									'cr_amount' => 0,
									'ref_no' => $ref_code,
									'bank' => $account['bank'],
									'ob' => 0,
									'posted' => 1,
									'created_at' => $date,
								);
								  $this->gl->save($bankGl);
								
								//credit interest account
								$account = $this->coa->where('glcode', $active_loan->loan_int_income_gl_account_no)->first();
								$bankGl = array(
									'glcode' => $active_loan->loan_int_income_gl_account_no,
									'posted_by' => $this->session->user_username,
									'narration' => 'Interest Due for '.$monthName.', '.$year. 'for '.$active_loan->loan_description,
									'dr_amount' => 0,
									'cr_amount' => $interest_amount,
									'ref_no' => $ref_code,
									'bank' => $account['bank'],
									'ob' => 0,
									'posted' => 1,
									'created_at' => $date,
								);
								 $this->gl->save($bankGl);
								
								
								
								$loan_details = $this->loan->where(['loan_id' => $active_loan->loan_id])->first();
								$loan_interest_amount = $loan_details['interest'] + $interest_amount;
								
								$loan_array = array('loan_id' => $active_loan->loan_id,
									'interest' => $loan_interest_amount,
								);
								$i = $this->loan->save($loan_array);
						
							
							endif;
							
							if($active_loan->interest_method == 3):
							
								$interest_rate = $active_loan->ls_interest_rate/100;
								$amount = $active_loan->amount;
								
								$interest_amount = $interest_rate * $amount;
								
								$dateObj   = DateTime::createFromFormat('!m', $month);
								$monthName = $dateObj->format('F');
								
								
								$lr_array = array(
									'lr_loan_id' => $active_loan->loan_id,
									'lr_month' => $month,
									'lr_year' => $year,
									'lr_amount' => $interest_amount,
									'lr_narration' => 'Interest Due for '.$monthName.', '.$year. 'for '.$active_loan->loan_description,
									'lr_dctype' => 2,
									'lr_ref' => $ref_code,
									'lr_mi' => 0,
									'lr_mpr' => 0,
									'lr_interest' => 1,
									'lr_interest_rate' => $active_loan->ls_interest_rate,
									'lr_date' => $date
								
								
								);
								
								$j = $this->lr->save($lr_array);
								
								$account = $this->coa->where('glcode', $active_loan->loan_gl_account_no)->first();
								$bankGl = array(
									'glcode' => $active_loan->loan_gl_account_no,
									'posted_by' => $this->session->user_username,
									'narration' => 'Interest Due for '.$monthName.', '.$year. 'for '.$active_loan->loan_description,
									'dr_amount' => $interest_amount,
									'cr_amount' => 0,
									'ref_no' => $ref_code,
									'bank' => $account['bank'],
									'ob' => 0,
									'posted' => 1,
									'created_at' => $date,
								);
								$this->gl->save($bankGl);
								
								//credit interest account
								$account = $this->coa->where('glcode', $active_loan->loan_int_income_gl_account_no)->first();
								$bankGl = array(
									'glcode' => $active_loan->loan_int_income_gl_account_no,
									'posted_by' => $this->session->user_username,
									'narration' => 'Interest Due for '.$monthName.', '.$year. 'for '.$active_loan->loan_description,
									'dr_amount' => 0,
									'cr_amount' => $interest_amount,
									'ref_no' => $ref_code,
									'bank' => $account['bank'],
									'ob' => 0,
									'posted' => 1,
									'created_at' => $date,
								);
								$this->gl->save($bankGl);
								
								$loan_details = $this->loan->where(['loan_id' => $active_loan->loan_id])->first();
								$loan_interest_amount = $loan_details['interest'] + $interest_amount;
								
								$loan_array = array('loan_id' => $active_loan->loan_id,
									'interest' => $loan_interest_amount,
								);
								$i = $this->loan->save($loan_array);
								
							endif;
							
							
							

							$ir_array = array(
								'ir_month' => $month,
								'ir_year' => $year,
								'ir_date' => $date
							);

		
							$k = $this->ir->save($ir_array);

						
								
						endforeach;
						
						if($k):
//						if(1):
							
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
						
						else:
							
							
							$data = array(
								'msg' => 'No loans available for routine',
								'type' => 'error',
								'location' => site_url('interest_routine')
							
							);
							
							return view('pages/sweet-alert', $data);
						endif;
					
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
	
	
	public function lr_upload(){
		
		$temp_lrs = $this->temp_lr->findAll();
		
		if(empty($temp_lrs)):
			$data['loan_types'] = $this->ls->findAll();
			$username = $this->session->user_username;
			$this->authenticate_user($username, 'pages/routine/lr_upload', $data);
		
		else:
			$temp_data = $this->temp_lr->first();
			$dateObj   = DateTime::createFromFormat('!m', $temp_data['temp_lr_month']);
			$data['monthName'] = $dateObj->format('F');
			$data['year'] = $temp_data['temp_lr_year'];
			$loan_id = $temp_data['temp_lr_loan_id'];
			$data['loan_type'] = $this->ls->where(['loan_setup_id' => $loan_id])->first();
			
			$data['temp_lrs'] = $this->temp_lr->findAll();
			$data['permission'] = 1;
			return view('pages/routine/view_lr_upload', $data);
		endif;
		
	}
	
	
	public function process_lr_upload(){
		
		$this->validator->setRules( [
			'lr_upload_lt'=>[
				'rules'=>'required',
				'errors'=>[
					'required'=>'Select a Loan Type'
				]
			],
			
			
			'lr_upload_date'=>[
				'rules'=>'required',
				'errors'=>[
					'required'=>'Enter a Date'
				]
			],
			
			'lr_upload_month'=>[
				'rules'=>'required',
				'errors'=>[
					'required'=>'Select a Month'
				]
			],
			
			'lr_upload_year'=>[
				'rules'=>'required',
				'errors'=>[
					'required'=>'Select a Year'
				]
			],
		
		]);
		
		if ($this->validator->withRequest($this->request)->run()):
			$this->temp_lr->delete_temp();
			$lt_id = $_POST['lr_upload_lt'];
			$lt_details = $this->ls->where('loan_setup_id', $lt_id)->first();
			$lr_month = $_POST['lr_upload_month'];
			$dateObj   = DateTime::createFromFormat('!m', $lr_month);
			$monthName = $dateObj->format('F');
			$lr_year = $_POST['lr_upload_year'];
			$date = $_POST['lr_upload_date'];
			$narration = 'Loan repayment on '.$lt_details['loan_description'].' for '.$monthName.', '.$lr_year;
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
						$staff_name = $row[1];
						$amount = $row[2];
						$cooperator_details = $this->cooperator->get_cooperator_staff_id($staff_id);
						
						// 1 == non existent cooperator
						// 2 == wrong loan
						// 3 == valid entry
						if(empty($cooperator_details)):
							
							$payment_details_array = array(
								'temp_lr_staff_id' => $staff_id,
								'temp_lr_staff_name' => $staff_name,
								'temp_lr_transaction_date' => $date,
								'temp_lr_narration' => $narration,
								'temp_lr_month' => $lr_month,
								'temp_lr_year' => $lr_year,
								'temp_lr_amount' => $amount,
								'temp_lr_drcrtype' => 1,
								'temp_lr_loan_id' => $lt_id,
								'temp_lr_ref_code' => $ref_code,
								'temp_lr_status' => 1
							);
						
						else:
							
							$loans = $this->loan->get_active_loans_staff_id($staff_id, $lt_id);
							$cooperator_pg =  $cooperator_details->cooperator_payroll_group_id;
							
							// $payment_details_array = $cooperator_details;
							
							
							if(empty($loans)):
								
								$payment_details_array = array(
									'temp_lr_staff_id' => $staff_id,
									'temp_lr_staff_name' => $staff_name,
									'temp_lr_transaction_date' => $date,
									'temp_lr_narration' => $narration,
									'temp_lr_month' => $lr_month,
									'temp_lr_year' => $lr_year,
									'temp_lr_amount' => $amount,
									'temp_lr_drcrtype' => 1,
									'temp_lr_loan_id' => $lt_id,
									'temp_lr_ref_code' => $ref_code,
									'temp_lr_status' => 2
								);
							
							else:
								
								$payment_details_array = array(
									'temp_lr_staff_id' => $staff_id,
									'temp_lr_staff_name' => $staff_name,
									'temp_lr_transaction_date' => $date,
									'temp_lr_narration' => $narration,
									'temp_lr_month' => $lr_month,
									'temp_lr_year' => $lr_year,
									'temp_lr_amount' => $amount,
									'temp_lr_drcrtype' => 1,
									'temp_lr_loan_id' => $lt_id,
									'temp_lr_ref_code' => $ref_code,
									'temp_lr_status' => 3
								);
							
							
							endif;
						
						
						endif;
						
						
						$v = $this->temp_lr->save($payment_details_array);

//                    print_r($payment_details_array);
//                    echo '<br>';
					
					endforeach;
					
					
					
					if($v):
						
						$temp_data = $this->temp_lr->first();
						$dateObj   = DateTime::createFromFormat('!m', $temp_data['temp_lr_month']);
						$data['monthName'] = $dateObj->format('F');
						$data['year'] = $temp_data['temp_lr_year'];
						$loan_id = $temp_data['temp_lr_loan_id'];
						$data['loan_type'] = $this->ls->where(['loan_setup_id' => $loan_id])->first();
						
						$data['temp_lrs'] = $this->temp_lr->findAll();
						$data['permission'] = 1;
						
						
						
						return view('pages/routine/view_lr_upload', $data);
					
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
	
	
	public  function p_lr_upload(){
		$temp_payments = $this->temp_lr->where(['temp_lr_status' => 1])->findAll();
		
		foreach ($temp_payments as $temp_payment):
			
			$exception_array = array(
				'loan_exception_staff_id' => $temp_payment['temp_lr_staff_id'],
				'loan_exception_staff_name' => $temp_payment['temp_lr_staff_name'],
				'loan_exception_transaction_date' => $temp_payment['temp_lr_transaction_date'],
				'loan_exception_month' => $temp_payment['temp_lr_month'],
				'loan_exception_year' => $temp_payment['temp_lr_year'],
				'loan_exception_amount' => $temp_payment['temp_lr_amount'],
				'loan_exception_ref_code' => $temp_payment['temp_lr_ref_code'],
				'loan_exception_reason' => "Member does not exist",
				'loan_exception_loan_type'=> $temp_payment['temp_lr_loan_id']
			);
			
			$v =  $this->le->save($exception_array);
		
		endforeach;
		
		$temp_payments = $this->temp_lr->where(['temp_lr_status' => 2])->findAll();
		
		foreach ($temp_payments as $temp_payment):
			
			$exception_array = array(
				'loan_exception_staff_id' => $temp_payment['temp_lr_staff_id'],
				'loan_exception_staff_name' => $temp_payment['temp_lr_staff_name'],
				'loan_exception_transaction_date' => $temp_payment['temp_lr_transaction_date'],
				'loan_exception_month' => $temp_payment['temp_lr_month'],
				'loan_exception_year' => $temp_payment['temp_lr_year'],
				'loan_exception_amount' => $temp_payment['temp_lr_amount'],
				'loan_exception_ref_code' => $temp_payment['temp_lr_ref_code'],
				'loan_exception_reason' => "Member does not have existing loan",
				'loan_exception_loan_type'=> $temp_payment['temp_lr_loan_id']
			);
			
			$v =  $this->le->save($exception_array);
		
		endforeach;
		
		
		$temp_payments = $this->temp_lr->where(['temp_lr_status' => 3])->findAll();
		
		foreach ($temp_payments as $temp_payment):
			$staff_id = $temp_payment['temp_lr_staff_id'];
			$loan_type = $temp_payment['temp_lr_loan_id'];
			
			
			$loans = $this->loan->get_active_loans_staff_id($staff_id, $loan_type);
			
			$loan_id = $loans->loan_id;
			$loan_amount = $loans->amount;
			
			# check for duplicate loan repayment upload for a month;
			
		$check  = $this->lr->where(['lr_loan_id' => $loan_id, 'lr_month'=>$temp_payment['temp_lr_month'], 'lr_year' => $temp_payment['temp_lr_year'], 'lr_dctype' => $temp_payment['temp_lr_drcrtype'] ])->findAll();
			
		if(empty($check)):
			$loan_ledgers = $this->loan->get_loans_staff_id($staff_id, $loan_id);
			
			$total_cr = 0;
			$total_dr = 0;
			$cr = 0;
			$dr = 0;
			$total_mi = 0;
			$total_interest = 0;
			$total_cr_mi = 0;
			$total_dr_mi = 0;
			
			foreach ($loan_ledgers as$loan_ledger):
				
				if($loan_ledger->lr_dctype == 1):
					$cr = $loan_ledger->lr_amount;
					$total_cr = $total_cr + $cr;
					
					$total_cr_mi = $total_cr_mi + $loan_ledger->lr_mi;
				endif;
				
				if($loan_ledger->lr_dctype == 2):
					$dr = $loan_ledger->lr_amount;
					$total_dr = $total_dr + $dr;
					
					$total_dr_mi = $total_dr_mi + $loan_ledger->lr_mi;
				endif;
				
				if($loan_ledger->lr_interest == 1):
					
					$total_interest = $total_interest + $loan_ledger->lr_amount;
				endif;
				
				//$total_interest = $total_interest + $loan_ledger->lr_mi;

//									if($loan_ledger->lr_dctype == 2):
//										$dr = $loan_ledger->lr_amount;
//										$total_dr = $total_dr + $dr;
//									endif;
			
			endforeach;
			
			$total_mi = $total_cr_mi - $total_dr_mi;
			
			$interest_unpaid = $total_interest - $total_mi;
			
			if($interest_unpaid >= $temp_payment['temp_lr_amount']):
				
				
					$mi = $temp_payment['temp_lr_amount'];
					$mpr = 0;
					
			else:
				
				$mi =$interest_unpaid;
				$mpr = $temp_payment['temp_lr_amount'] - $interest_unpaid;
			
			endif;
			
			
			$loan_repayment = array(
				'lr_staff_id' => $temp_payment['temp_lr_staff_id'],
				'lr_loan_id' => $loan_id,
				'lr_month' => $temp_payment['temp_lr_month'],
				'lr_year' => $temp_payment['temp_lr_year'],
				'lr_amount' => $temp_payment['temp_lr_amount'],
				'lr_dctype' => $temp_payment['temp_lr_drcrtype'],
				'lr_ref' => $temp_payment['temp_lr_ref_code'],
				'lr_narration' => $temp_payment['temp_lr_narration'],
				'lr_mi' => $mi,
				'lr_mpr' => $mpr,
				'lr_interest' => 0,
				'lr_date' => $temp_payment['temp_lr_transaction_date'],
			);
			
			
			$v =   $this->lr->save($loan_repayment);
			
			$account = $this->coa->where('glcode', $loans->payroll_gl)->first();
			$bankGl = array(
				'glcode' => $loans->payroll_gl,
				'posted_by' => $this->session->user_username,
				'narration' => $temp_payment['temp_lr_narration'],
				'dr_amount' => $temp_payment['temp_lr_amount'],
				'cr_amount' => 0,
				'ref_no' =>$temp_payment['temp_lr_ref_code'],
				'bank' => $account['bank'],
				'ob' => 0,
				'posted' => 1,
				'created_at' => $temp_payment['temp_lr_transaction_date'],
			);
			$this->gl->save($bankGl);
			
			//credit interest account
			$account = $this->coa->where('glcode', $loans->loan_gl_account_no)->first();
			$bankGl = array(
				'glcode' => $loans->loan_gl_account_no,
				'posted_by' => $this->session->user_username,
				'narration' => $temp_payment['temp_lr_narration'],
				'dr_amount' => 0,
				'cr_amount' => $temp_payment['temp_lr_amount'],
				'ref_no' =>$temp_payment['temp_lr_ref_code'],
				'bank' => $account['bank'],
				'ob' => 0,
				'posted' => 1,
				'created_at' => $temp_payment['temp_lr_transaction_date'],
			);
			$this->gl->save($bankGl);
			
			
			$loan_ledgers = $this->loan->get_loans_staff_id($staff_id, $loan_id);
			
			$total_cr = 0;
			$total_dr = 0;
			$cr = 0;
			$dr = 0;
			$total_mi = 0;
			$total_interest = 0;
			$total_cr_mi = 0;
			$total_dr_mi = 0;
			
			foreach ($loan_ledgers as$loan_ledger):
				
				if($loan_ledger->lr_dctype == 1):
					$cr = $loan_ledger->lr_amount;
					$total_cr = $total_cr + $cr;
					
					$total_cr_mi = $total_cr_mi + $loan_ledger->lr_mi;
				endif;
				
				if($loan_ledger->lr_dctype == 2):
					$dr = $loan_ledger->lr_amount;
					$total_dr = $total_dr + $dr;
					
					$total_dr_mi = $total_dr_mi + $loan_ledger->lr_mi;
				endif;

			
			endforeach;
			
			$balance =  $loan_amount+($total_dr - $total_cr);
			
//			echo 'total dr: '.$total_dr.'<br>';
//			echo 'total cr: '.$total_cr.'<br>';
//			echo 'balance: '.$balance;
			
			if($balance <= 0):

				$loan_array = array(
					'loan_id' => $loan_id,
					'paid_back' => 1
				);

			$this->loan->save($loan_array);

			endif;
			
		else:
			
			$v = 1;
		
		
		endif;
		
		endforeach;
		
		if($v):
			$this->temp_lr->delete_temp();
			$data = array(
				'msg' => 'Action Successful',
				'type' => 'success',
				'location' => site_url('lr_upload')

			);

			return view('pages/sweet-alert', $data);

		else:

			$data = array(
				'msg' => 'An error Occurred',
				'type' => 'error',
				'location' => site_url('lr_upload')

			);

			return view('pages/sweet-alert', $data);

		endif;
	}
	
	public function cancel_lr_upload(){
		
		$referrer = $this->request->getUserAgent()->getReferrer();
		
		if($referrer == base_url('lr_upload')):
			
			$this->temp_lr->delete_temp();
			$data = array(
				'msg' => 'Action Successful',
				'type' => 'success',
				'location' => site_url('lr_upload')
			
			);
			
			return view('pages/sweet-alert', $data);
		
		else:
			$data = array(
				'msg' => 'An Error Occurred',
				'type' => 'error',
				'location' => site_url()
			
			);
			
			return view('pages/sweet-alert', $data);
		
		
		
		endif;
	}
	
	public function savings_exception(){
		
		$method = $this->request->getMethod();
		
		if($method == 'post'):
			$year = $this->request->getPost('year');
			$month = $this->request->getPost('month');
				
				
				$data['exceptions'] = $this->exception->where(['exception_month' => $month, 'exception_year' => $year])->findAll();
				$data['check'] = 1;
				$dateObj   = DateTime::createFromFormat('!m', $month);
				$monthName = $dateObj->format('F');
				$data['m'] = $monthName;
				$username = $this->session->user_username;
				$data['y'] = $year;
				$data['years'] = $this->exception->get_years();
				
				
				$this->authenticate_user($username, 'pages/routine/savings_exception', $data);
			
		endif;
		if($method == 'get'):
			$username = $this->session->user_username;
			$data['years'] = $this->exception->get_years();
			$data['check'] = 0;
			$this->authenticate_user($username, 'pages/routine/savings_exception', $data);
		
		endif;
 
	}
	
	public function lr_exception(){
		$method = $this->request->getMethod();
		
		if($method == 'post'):
			$year = $this->request->getPost('year');
			$month = $this->request->getPost('month');
			$loan_type = $this->request->getPost('loan_type');
			
			$data['loan'] = $this->ls->where(['loan_setup_id' => $loan_type])->first();
			
			
			$data['exceptions'] = $this->le->where(['loan_exception_month' => $month, 'loan_exception_year' => $year, 'loan_exception_loan_type'=> $loan_type])->findAll();
			$data['check'] = 1;
			$dateObj   = DateTime::createFromFormat('!m', $month);
			$monthName = $dateObj->format('F');
			$data['m'] = $monthName;
			$username = $this->session->user_username;
			$data['y'] = $year;
			$data['years'] = $this->le->get_years();
			$data['loan_details'] = $this->ls->findAll();
			
			
			$this->authenticate_user($username, 'pages/routine/lr_exception', $data);
		
		endif;
		if($method == 'get'):
			$username = $this->session->user_username;
			$data['years'] = $this->le->get_years();
			$data['check'] = 0;
			$data['loan_details'] = $this->ls->findAll();
			$this->authenticate_user($username, 'pages/routine/lr_exception', $data);
		
		endif;
		
		
	}
	
}
