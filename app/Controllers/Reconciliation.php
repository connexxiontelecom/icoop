<?php
	
	
	namespace App\Controllers;
	use App\Models\AccountClosureModel;
	use App\Models\ContributionTypeModel;
	use App\Models\Cooperators;
	use App\Models\ExceptionModel;
	use App\Models\PaymentDetailsModel;
	use App\Models\PayrollGroups;
	use App\Models\PolicyConfigModel;
	use App\Models\TempPaymentsModel;
	use App\Models\GlModel;
	use App\Models\CoaModel;
	use App\Models\ReconciliationModel;
	use App\Models\LoanModel;
	use App\Models\LoanRepaymentModel;
	
	class Reconciliation extends BaseController
	{
		public function __construct(){
			$this->pg = new PayrollGroups();
			$this->contribution_type = new ContributionTypeModel();
			$this->cooperator = new Cooperators();
			$this->temp_pd = new TempPaymentsModel();
			$this->pd = new PaymentDetailsModel();
			$this->exception = new ExceptionModel();
			$this->gl = new GlModel();
			$this->policy = new PolicyConfigModel();
			$this->ac = new AccountClosureModel();
			$this->coa = new CoaModel();
			$this->re = new ReconciliationModel();
			$this->loan = new LoanModel();
			$this->lr = new LoanRepaymentModel();
			
			
		}
		
		
		public function new_savings_reconciliation(){
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['accounts'] = $this->coa->where('type', 1)->findAll();
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/reconciliation/new_savings_reconciliation', $data);
			
			endif;
			
			if($method == 'post'):
				
				
				$this->validator->setRules( [
					'staff_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter Staff ID'
						]
					],
					
					'ct_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a Contribution Type'
						]
					],
					
					'amount'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],
					
					'transaction_type'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a transaction type'
						]
					],
					
					'account'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select destination account'
						]
					],
				
				
				
				]);
				if ($this->validator->withRequest($this->request)->run()):
					$staff_id = $_POST['staff_id'];
					$staff_id = substr($staff_id, 0, strpos($staff_id, ','));
					
					$cooperator = $this->cooperator->where(['cooperator_staff_id' => $staff_id])->first();
					
					if($cooperator['cooperator_status'] == 2):
						
						
						$check_closure = $this->ac->check_ac($staff_id);
						
						if(empty($check_closure)):
							
							$file = $this->request->getFile('reconciliation_file');
//
								if(!empty($file)):
									
									if($file->isValid() && !$file->hasMoved()):
										
										$extension = $file->guessExtension();
										$extension = strtolower($extension);
										
										if($extension == 'pdf'):
											
											$file_name = $file->getRandomName();
											
											
											
											$file->move('.uploads/reconciliation', $file_name);
											
										
										
										else:
											
											$data = array(
												'msg' => 'Only PDF files are allowed',
												'type' => 'error',
												'location' => base_url('new_savings_reconciliation')
											
											);
											
											echo view('pages/sweet-alert', $data);
										
										endif;
									endif;
									
								else:
									$file_name = null;
									
								endif;
						
							$transaction_type = $_POST['transaction_type'];
							$ref_no = time();
						
						if($transaction_type == 2):
							
							$balance = $_POST['balance'];
							$amount = $_POST['amount'];
							
							$re_array = array(
								're_staff_id' => $staff_id,
								're_type' => 1,
								're_narration' => $_POST['narration'].' -(Savings Reconciliation)',
								're_source' => $_POST['ct_id'],
								're_destination' => $_POST['account'],
								're_amount' => (float)str_replace(',', '', $_POST['amount']),
								're_ref_no' => $ref_no,
								're_dctype' => 2,
								're_transaction_date' => $_POST['date'],
								're_by'=> $this->session->user_username,
								're_date' => date('Y-m-d'),
							
							);
							
							
							$v =  $this->re->save($re_array);
							
							if($v):
								
								$data = array(
									'msg' => 'Action Successful',
									'type' => 'success',
									'location' => base_url('new_savings_reconciliation')
								
								);
								return view('pages/sweet-alert', $data);
							
							else:
								$data = array(
									'msg' => 'An Error Occured',
									'type' => 'error',
									'location' => base_url('new_savings_reconciliation')
								
								);
								return view('pages/sweet-alert', $data);
							
							
							endif;
											
//											if($amount > $balance):
//												$data = array(
//													'msg' => 'Insufficient Balance',
//													'type' => 'error',
//													'location' => base_url('new_savings_reconciliation')
//
//												);
//
//												return view('pages/sweet-alert', $data);
//
//
//											else:
//
//
//											endif;
							
							
							endif;
						
						
						
						if($transaction_type == 1):
							$re_array = array(
								're_staff_id' => $staff_id,
								're_type' => 1,
								're_narration' => $_POST['narration'].' -(Savings Reconciliation)',
								're_source' => $_POST['ct_id'],
								're_destination' => $_POST['account'],
								're_amount' => (float)str_replace(',', '', $_POST['amount']),
								're_ref_no' => $ref_no,
								're_dctype' => 1,
								're_transaction_date' => $_POST['date'],
								're_by'=> $this->session->user_username,
								're_date' => date('Y-m-d'),
							
							);
							
							
							$v =  $this->re->save($re_array);
							
							if($v):
								
								$data = array(
									'msg' => 'Action Successful',
									'type' => 'success',
									'location' => base_url('new_savings_reconciliation')
								
								);
								return view('pages/sweet-alert', $data);
							
							else:
								$data = array(
									'msg' => 'An Error Occurred',
									'type' => 'error',
									'location' => base_url('new_savings_reconciliation')
								
								);
								return view('pages/sweet-alert', $data);
							
							
							endif;
							
							
							endif;

						else:
							
							$data = array(
								'msg' => 'Account is undergoing closure',
								'type' => 'error',
								'location' => base_url('new_savings_reconciliation')
							
							);
							
							echo view('pages/sweet-alert', $data);
						
						endif;
					endif;
					
					if($cooperator['cooperator_status'] == 0):
						
						
						
						$data = array(
							'msg' => 'Account has been frozen',
							'type' => 'error',
							'location' => base_url('new_savings_reconciliation')
						
						);
						
						echo view('pages/sweet-alert', $data);
					endif;
				
				
				else:
					
					$arr = $this->validator->getErrors();
					
					$data = array(
						'msg' => implode(", ", $arr),
						'type' => 'error',
						'location' => base_url('new_savings_reconciliation')
					
					);
					
					echo view('pages/sweet-alert', $data);
				
				
				endif;
			
			endif;
		}
		
		
		public function verify_savings_reconciliation(){
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['accounts'] = $this->coa->where('type', 1)->findAll();
				$data['reconciliations'] = $this->re->get_reconciliations(1, 0);
				$username = $this->session->user_username;
				

				$this->authenticate_user($username, 'pages/reconciliation/verify_savings_reconciliation', $data);
			
			endif;
			
			if($method == 'post'):
				
				$re_status = $_POST['re_status'];
				
				if($re_status == 1):
					
					$_POST['re_verify_date'] = date('Y-m-d');
					$_POST['re_verify_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					//print_r($_POST);
					
					$v = $this->re->save($_POST);
					
					if($v):

						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('verify_savings_reconciliation')

						);
						return view('pages/sweet-alert', $data);

					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('verify_savings_reconciliation')

						);
						return view('pages/sweet-alert', $data);


					endif;
				
				
				endif;
				if($re_status == 3):
					
					$_POST['re_discard_date'] = date('Y-m-d');
					$_POST['re_discard_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					
					$v = $this->re->save($_POST);
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('verify_savings_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('verify_savings_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
		
			
			endif;
		}
		
		
		public function approve_savings_reconciliation(){
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['accounts'] = $this->coa->where('type', 1)->findAll();
				$data['reconciliations'] = $this->re->get_reconciliations(1, 1);
				$username = $this->session->user_username;
				
				
				$this->authenticate_user($username, 'pages/reconciliation/approve_savings_reconciliation', $data);
			
			endif;
			
			if($method == 'post'):
				
				$re_status = $_POST['re_status'];
				
				if($re_status == 2):
					$re_id = $_POST['re_id'];
					$_POST['re_approved_date'] = date('Y-m-d');
					$_POST['re_approved_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					//print_r($_POST);
					
					$v = $this->re->save($_POST);
					
					
					$reconciliation_detail = $this->re->where('re_id', $re_id)->first();
					
					$time = strtotime($reconciliation_detail['re_transaction_date']);
					
					$month = date("n",$time);
					$year=date("Y",$time);
					
					$coop = $this->cooperator->where(['cooperator_staff_id' =>$reconciliation_detail['re_staff_id'] ])->first();
					
					if($reconciliation_detail['re_dctype'] == 1): //credit action
																		
						$payment_details_array = array(
							'pd_staff_id' => $reconciliation_detail['re_staff_id'],
							'pd_transaction_date' => $reconciliation_detail['re_transaction_date'],
							'pd_narration' => $reconciliation_detail['re_narration'],
							'pd_amount' => $reconciliation_detail['re_amount'],
							'pd_payment_type' => 6,
							'pd_drcrtype' => 1,
							'pd_ct_id' => $reconciliation_detail['re_source'],
							'pd_pg_id' => $coop['cooperator_payroll_group_id'],
							'pd_ref_code' => $reconciliation_detail['re_ref_no'],
							'pd_month' => $month,
							'pd_year' => $year
						);
						
						
						$v =   $this->pd->save($payment_details_array);
						
						$wt = $this->contribution_type->where('contribution_type_id', $reconciliation_detail['re_source'])->first();
						$account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();
						
						$bankGl = array(
							'glcode' => $wt['contribution_type_glcode'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => 0,
							'cr_amount' => $reconciliation_detail['re_amount'],
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' =>  $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
						
						//debit destination
						
						$account = $this->coa->where('glcode', $reconciliation_detail['re_destination'])->first();
						
						$bankGl = array(
							'glcode' => $reconciliation_detail['re_destination'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => $reconciliation_detail['re_amount'],
							'cr_amount' => 0,
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' =>  $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
						
						
						endif;
					
					
					if($reconciliation_detail['re_dctype'] == 2): //debit action
						
						$payment_details_array = array(
							'pd_staff_id' => $reconciliation_detail['re_staff_id'],
							'pd_transaction_date' => $reconciliation_detail['re_transaction_date'],
							'pd_narration' => $reconciliation_detail['re_narration'],
							'pd_amount' => $reconciliation_detail['re_amount'],
							'pd_payment_type' => 6,
							'pd_drcrtype' => 2,
							'pd_ct_id' => $reconciliation_detail['re_source'],
							'pd_pg_id' => $coop['cooperator_payroll_group_id'],
							'pd_ref_code' => $reconciliation_detail['re_ref_no'],
							'pd_month' => $month,
							'pd_year' => $year
						);
					
						$v =   $this->pd->save($payment_details_array);
						
						$wt = $this->contribution_type->where('contribution_type_id', $reconciliation_detail['re_source'])->first();
						$account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();
						
						$bankGl = array(
							'glcode' => $wt['contribution_type_glcode'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => $reconciliation_detail['re_amount'],
							'cr_amount' => 0,
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' => $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
						
						//debit destination
						
						$account = $this->coa->where('glcode', $reconciliation_detail['re_destination'])->first();
						
						$bankGl = array(
							'glcode' => $reconciliation_detail['re_destination'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => 0,
							'cr_amount' => $reconciliation_detail['re_amount'],
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' =>  $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
					
					endif;
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('approve_savings_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('approve_savings_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
				if($re_status == 3):
					
					$_POST['re_discard_date'] = date('Y-m-d');
					$_POST['re_discard_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					
					$v = $this->re->save($_POST);
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('approve_savings_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('approve_savings_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
			
			
			endif;
		}
		
		
		public function new_loans_reconciliation(){
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['accounts'] = $this->coa->where('type', 1)->findAll();
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/reconciliation/new_loans_reconciliation', $data);
			
			endif;
			
			if($method == 'post'):
				
				
				$this->validator->setRules( [
					'staff_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter Staff ID'
						]
					],
					
					'loan_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a Contribution Type'
						]
					],
					
					'amount'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],
					
					'transaction_type'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a transaction type'
						]
					],
					
					'account'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select destination account'
						]
					],
				
				
				
				]);
				if ($this->validator->withRequest($this->request)->run()):
					$staff_id = $_POST['staff_id'];
					$staff_id = substr($staff_id, 0, strpos($staff_id, ','));
					
					$cooperator = $this->cooperator->where(['cooperator_staff_id' => $staff_id])->first();
					
					if($cooperator['cooperator_status'] == 2):
						
						
						$check_closure = $this->ac->check_ac($staff_id);
						
						if(empty($check_closure)):
							
							$file = $this->request->getFile('reconciliation_file');
//
							if(!empty($file)):
								
								if($file->isValid() && !$file->hasMoved()):
									
									$extension = $file->guessExtension();
									$extension = strtolower($extension);
									
									if($extension == 'pdf'):
										
										$file_name = $file->getRandomName();
										
										
										
										$file->move('.uploads/reconciliation', $file_name);
									
									
									
									else:
										
										$data = array(
											'msg' => 'Only PDF files are allowed',
											'type' => 'error',
											'location' => base_url('new_loans_reconciliation')
										
										);
										
										echo view('pages/sweet-alert', $data);
									
									endif;
								endif;
							
							else:
								$file_name = null;
							
							endif;
							
							$transaction_type = $_POST['transaction_type'];
							$ref_no = time();
							
							if($transaction_type == 2):
								
								$re_array = array(
									're_staff_id' => $staff_id,
									're_type' => 2,
									're_narration' => $_POST['narration'].' -(Loans Reconciliation)',
									're_source' => $_POST['loan_id'],
									're_destination' => $_POST['account'],
									're_amount' => (float)str_replace(',', '', $_POST['amount']),
									're_ref_no' => $ref_no,
									're_dctype' => 2,
									're_transaction_date' => $_POST['date'],
									're_by'=> $this->session->user_username,
									're_date' => date('Y-m-d'),
								
								);
								
								
								$v =  $this->re->save($re_array);
								
								if($v):
									
									$data = array(
										'msg' => 'Action Successful',
										'type' => 'success',
										'location' => base_url('new_loans_reconciliation')
									
									);
									return view('pages/sweet-alert', $data);
								
								else:
									$data = array(
										'msg' => 'An Error Occured',
										'type' => 'error',
										'location' => base_url('new_loans_reconciliation')
									
									);
									return view('pages/sweet-alert', $data);
								
								
								endif;
							
							
							endif;
							
							
							
							if($transaction_type == 1):
								$balance = $_POST['balance'];
								$amount = $_POST['amount'];
								
								if($amount > $balance):
									
									$data = array(
										'msg' => 'Amount cannot be greater than balance',
										'type' => 'error',
										'location' => base_url('new_loans_reconciliation')
									
									);
									
									return view('pages/sweet-alert', $data);
									
									else:
									
									$mi = $_POST['mi'];
									$mpr = $_POST['mpr'];
										
										$re_array = array(
											're_staff_id' => $staff_id,
											're_type' => 2,
											're_narration' => $_POST['narration'].' -(Loans Reconciliation)',
											're_source' => $_POST['loan_id'],
											're_destination' => $_POST['account'],
											're_amount' => (float)str_replace(',', '', $_POST['amount']),
											're_mi' => (float)str_replace(',', '', $mi),
											're_mpr' => (float)str_replace(',', '', $mpr),
											're_ref_no' => $ref_no,
											're_dctype' => 1,
											're_transaction_date' => $_POST['date'],
											're_by'=> $this->session->user_username,
											're_date' => date('Y-m-d'),
										
										);
										
										
										$v =  $this->re->save($re_array);
										
										if($v):
											
											$data = array(
												'msg' => 'Action Successful',
												'type' => 'success',
												'location' => base_url('new_loans_reconciliation')
											
											);
											return view('pages/sweet-alert', $data);
										
										else:
											$data = array(
												'msg' => 'An Error Occurred',
												'type' => 'error',
												'location' => base_url('new_loans_reconciliation')
											
											);
											return view('pages/sweet-alert', $data);
										
										
										endif;
										
										
										
										endif;
								
								
							
							
							endif;
						
						else:
							
							$data = array(
								'msg' => 'Account is undergoing closure',
								'type' => 'error',
								'location' => base_url('new_loans_reconciliation')
							
							);
							
							echo view('pages/sweet-alert', $data);
						
						endif;
					endif;
					
					if($cooperator['cooperator_status'] == 0):
						
						
						
						$data = array(
							'msg' => 'Account has been frozen',
							'type' => 'error',
							'location' => base_url('new_loans_reconciliation')
						
						);
						
						echo view('pages/sweet-alert', $data);
					endif;
				
				
				else:
					
					$arr = $this->validator->getErrors();
					
					$data = array(
						'msg' => implode(", ", $arr),
						'type' => 'error',
						'location' => base_url('new_loans_reconciliation')
					
					);
					
					echo view('pages/sweet-alert', $data);
				
				
				endif;
			
			endif;
		}
		
		
		public function verify_loans_reconciliation(){
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['accounts'] = $this->coa->where('type', 1)->findAll();
				$data['reconciliations'] = $this->re->get_reconciliations(2, 0);
				$username = $this->session->user_username;
				
				
				$this->authenticate_user($username, 'pages/reconciliation/verify_loans_reconciliation', $data);
			
			endif;
			
			if($method == 'post'):
				
				$re_status = $_POST['re_status'];
				
				if($re_status == 1):
					
					$_POST['re_verify_date'] = date('Y-m-d');
					$_POST['re_verify_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					//print_r($_POST);
					
					$v = $this->re->save($_POST);
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('verify_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('verify_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
				if($re_status == 3):
					
					$_POST['re_discard_date'] = date('Y-m-d');
					$_POST['re_discard_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					
					$v = $this->re->save($_POST);
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('verify_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('verify_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
			
			
			endif;
		}
		
		
		public function approve_loans_reconciliation(){
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['accounts'] = $this->coa->where('type', 1)->findAll();
				$data['reconciliations'] = $this->re->get_reconciliations(2, 1);
				$username = $this->session->user_username;
				
				
				$this->authenticate_user($username, 'pages/reconciliation/approve_loans_reconciliation', $data);
			
			endif;
			
			if($method == 'post'):
				
				$re_status = $_POST['re_status'];
				
				if($re_status == 2):
					$re_id = $_POST['re_id'];
					$_POST['re_approved_date'] = date('Y-m-d');
					$_POST['re_approved_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					//print_r($_POST);
					
					$v = $this->re->save($_POST);
					
					
					$reconciliation_detail = $this->re->where('re_id', $re_id)->first();
					
					$time = strtotime($reconciliation_detail['re_transaction_date']);
					
					$month = date("n",$time);
					$year=date("Y",$time);
					
					$coop = $this->cooperator->where(['cooperator_staff_id' =>$reconciliation_detail['re_staff_id'] ])->first();
					$active_loan = $this->loan->get_loan($reconciliation_detail['re_source']);
					
					if($reconciliation_detail['re_dctype'] == 1): //credit action
						
				
					
						$lr_array = array(
							'lr_loan_id' => $reconciliation_detail['re_source'],
							'lr_month' => $month,
							'lr_year' => $year,
							'lr_amount' => $reconciliation_detail['re_amount'],
							'lr_narration' => $reconciliation_detail['re_narration'],
							'lr_dctype' => 1,
							'lr_ref' => $reconciliation_detail['re_ref_no'],
							'lr_mi' => $reconciliation_detail['re_mi'],
							'lr_mpr' => $reconciliation_detail['re_mpr'],
							'lr_interest' => 0,
							'lr_interest_rate' => $active_loan['ls_interest_rate'],
							'lr_date' => $reconciliation_detail['re_transaction_date']
						
						
						);
						
						$v =   $this->lr->save($lr_array);
						
//						$wt = $this->loan->where('contribution_type_id', $reconciliation_detail['re_source'])->first();
						$account = $this->coa->where('glcode', $active_loan['loan_gl_account_no'])->first();
						
						$bankGl = array(
							'glcode' => $active_loan['loan_gl_account_no'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => 0,
							'cr_amount' => $reconciliation_detail['re_amount'],
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' => $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
						
						//debit destination
						
						$account = $this->coa->where('glcode', $reconciliation_detail['re_destination'])->first();
						
						$bankGl = array(
							'glcode' => $reconciliation_detail['re_destination'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => $reconciliation_detail['re_amount'],
							'cr_amount' => 0,
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' =>  $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
						
						
						
						$loan_ledgers = $this->loan->get_loans_staff_id($reconciliation_detail['re_staff_id'], $reconciliation_detail['re_source']);
						
						$total_cr = 0;
						$total_dr = 0;
						$cr = 0;
						$dr = 0;
						$total_mi = 0;
						$total_interest = 0;
						$total_cr_mi = 0;
						$total_dr_mi = 0;
						$total_principal = 0;
						
						foreach ($loan_ledgers as$loan_ledger):
							
							if($loan_ledger->lr_dctype == 1):
								$cr = $loan_ledger->lr_amount;
								$total_cr = $total_cr + $cr;
								
								$total_cr_mi = $total_cr_mi + $loan_ledger->lr_mi;
								$total_principal = $total_principal + $loan_ledger->lr_mpr;
							endif;
							
							if($loan_ledger->lr_dctype == 2):
								$dr = $loan_ledger->lr_amount;
								$total_dr = $total_dr + $dr;
								
								$total_dr_mi = $total_dr_mi + $loan_ledger->lr_mi;
							endif;
							
							
							$psr = $loan_ledger->psr;
							$psr_value = $loan_ledger->psr_value;
						endforeach;
						
						$balance =  $active_loan['amount']+($total_dr - $total_cr);
						$total_principal = $active_loan['amount'] - $total_principal;
						
						if($psr == 1):
							
							$new_encumbrance_amount = ($psr_value/100) * $total_principal;
							$loan_array = array(
								'loan_id' => $reconciliation_detail['re_source'],
								'encumbrance_amount' => $new_encumbrance_amount
							);
							
							$this->loan->save($loan_array);
						endif;
						
						//$balance =  $active_loan['amount']+($total_dr - $total_cr);

//			echo 'total dr: '.$total_dr.'<br>';
//			echo 'total cr: '.$total_cr.'<br>';
//			echo 'balance: '.$balance;
						
						if($balance <= 0):
							
							$loan_array = array(
								'loan_id' => $reconciliation_detail['re_source'],
								'paid_back' => 1
							);
							
							$this->loan->save($loan_array);
						
						endif;
					
					
					endif;
					
					
					if($reconciliation_detail['re_dctype'] == 2): //debit action
						
						$lr_array = array(
							'lr_loan_id' => $reconciliation_detail['re_source'],
							'lr_month' => $month,
							'lr_year' => $year,
							'lr_amount' => $reconciliation_detail['re_amount'],
							'lr_narration' => $reconciliation_detail['re_narration'],
							'lr_dctype' => 2,
							'lr_ref' => $reconciliation_detail['re_ref_no'],
							'lr_mi' => $reconciliation_detail['re_mi'],
							'lr_mpr' => $reconciliation_detail['re_mpr'],
							'lr_interest' => 0,
							'lr_interest_rate' => $active_loan['ls_interest_rate'],
							'lr_date' => $reconciliation_detail['re_transaction_date']
						
						
						);
						
						$v =   $this->lr->save($lr_array);
						
						$loan_ledgers = $this->loan->get_loans_staff_id($reconciliation_detail['re_staff_id'], $reconciliation_detail['re_source']);
						
						$total_cr = 0;
						$total_dr = 0;
						$cr = 0;
						$dr = 0;
						$total_mi = 0;
						$total_interest = 0;
						$total_cr_mi = 0;
						$total_dr_mi = 0;
						$total_principal = 0;
						
				
						
						foreach ($loan_ledgers as$loan_ledger):
							
							if($loan_ledger->lr_dctype == 1):
								$cr = $loan_ledger->lr_amount;
								$total_cr = $total_cr + $cr;
								
								$total_cr_mi = $total_cr_mi + $loan_ledger->lr_mi;
								$total_principal = $total_principal + $loan_ledger->lr_mpr;
							endif;
							
							if($loan_ledger->lr_dctype == 2):
								$dr = $loan_ledger->lr_amount;
								$total_dr = $total_dr + $dr;
								
								$total_dr_mi = $total_dr_mi + $loan_ledger->lr_mi;
							endif;
							
							
							$psr = $loan_ledger->psr;
							$psr_value = $loan_ledger->psr_value;
						endforeach;
						
						$balance =  $active_loan['amount']+($total_dr - $total_cr);
						$total_principal = $active_loan['amount'] - $total_principal;
						
						
						
						if($psr == 1):
							
							$new_encumbrance_amount = ($psr_value/100) * $total_principal;
							$loan_array = array(
								'loan_id' => $reconciliation_detail['re_source'],
								'encumbrance_amount' => $new_encumbrance_amount
							);
							
							
							
							$this->loan->save($loan_array);
						endif;
						
						//$balance =  $active_loan['amount']+($total_dr - $total_cr);

//			echo 'total dr: '.$total_dr.'<br>';
//			echo 'total cr: '.$total_cr.'<br>';
//			echo 'balance: '.$balance;
						
						if($balance <= 0):
							
							$loan_array = array(
								'loan_id' => $reconciliation_detail['re_source'],
								'paid_back' => 1
							);
							
							$this->loan->save($loan_array);
						
						endif;
						
						$wt = $this->contribution_type->where('contribution_type_id', $reconciliation_detail['re_source'])->first();
						$account = $this->coa->where('glcode', $active_loan['loan_gl_account_no'])->first();
						
						$bankGl = array(
							'glcode' => $active_loan['loan_gl_account_no'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => $reconciliation_detail['re_amount'],
							'cr_amount' => 0,
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' =>  $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
						
						//debit destination
						
						$account = $this->coa->where('glcode', $reconciliation_detail['re_destination'])->first();
						
						$bankGl = array(
							'glcode' => $reconciliation_detail['re_destination'],
							'posted_by' => $this->session->user_username,
							'narration' => $reconciliation_detail['re_narration'],
							'dr_amount' => 0,
							'cr_amount' => $reconciliation_detail['re_amount'],
							'ref_no' =>$reconciliation_detail['re_ref_no'],
							'bank' => $account['bank'],
							'ob' => 0,
							'posted' => 1,
							'created_at' =>  $reconciliation_detail['re_transaction_date'],
						);
						$this->gl->save($bankGl);
					
					endif;
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('approve_loans_reconciliation')

						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('approve_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
				if($re_status == 3):
					
					$_POST['re_discard_date'] = date('Y-m-d');
					$_POST['re_discard_by']  = $this->session->user_username;
					$_POST['re_status'] = (int)$_POST['re_status'];
					
					$v = $this->re->save($_POST);
					
					if($v):
						
						$data = array(
							'msg' => 'Action Successful',
							'type' => 'success',
							'location' => base_url('approve_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					else:
						$data = array(
							'msg' => 'An Error Occurred',
							'type' => 'error',
							'location' => base_url('approve_loans_reconciliation')
						
						);
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				
				endif;
			
			
			endif;
		}
	
	}
