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
	
	use App\Models\CoaModel;
	use App\Models\ReconciliationModel;
	
	class Reconciliation extends BaseController
	{
		public function __construct(){
			$this->pg = new PayrollGroups();
			$this->contribution_type = new ContributionTypeModel();
			$this->cooperator = new Cooperators();
			$this->temp_pd = new TempPaymentsModel();
			$this->pd = new PaymentDetailsModel();
			$this->exception = new ExceptionModel();
			
			$this->policy = new PolicyConfigModel();
			$this->ac = new AccountClosureModel();
			$this->coa = new CoaModel();
			$this->re = new ReconciliationModel();
			
			
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
						
						if($transaction_type == 2):
							
							$balance = $_POST['balance'];
											$amount = $_POST['amount'];
											
											if($amount > $balance):
												$data = array(
													'msg' => 'Insufficient Balance',
													'type' => 'error',
													'location' => base_url('new_savings_reconciliation')
												
												);
												
												return view('pages/sweet-alert', $data);
											
											
											else:
											$re_array = array(
												're_staff_id' => $staff_id,
												're_type' => 1,
												're_narration' => 'Savings Reconciliation',
												're_source' => $_POST['ct_id'],
												're_destination' => $_POST['account'],
												're_amount' => (float)str_replace(',', '', $_POST['amount']),
												're_dctype' => 2,
												're_transaction_date' => date('Y-m-d'),
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
											
											endif;
							
							
							endif;
						
						
						
						if($transaction_type == 1):
							$re_array = array(
								're_staff_id' => $staff_id,
								're_type' => 1,
								're_narration' => 'Savings Reconciliation',
								're_source' => $_POST['ct_id'],
								're_destination' => $_POST['account'],
								're_amount' => (float)str_replace(',', '', $_POST['amount']),
								're_dctype' => 1,
								're_transaction_date' => date('Y-m-d'),
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
					
					if($reconciliation_detail['re_dctype'] == 1): //credit action
						
						$payment_details_array = array(
							'pd_staff_id' => $reconciliation_detail['re_staff_id'],
							'pd_transaction_date' => $reconciliation_detail['re_transaction_date'],
							'pd_narration' => $reconciliation_detail['re_narration'],
							'pd_amount' => $reconciliation_detail['re_amount'],
							'pd_payment_type' => 6,
							'pd_drcrtype' => 1,
							'pd_ct_id' => $reconciliation_detail['re_source'],
							'pd_pg_id' => $reconciliation_detail['re_pg_id'],
							'pd_ref_code' => $reconciliation_detail['re_ref_code'],
							'pd_month' => $reconciliation_detail['re_month'],
							'pd_year' => $reconciliation_detail['re_year']
						);
						
						
						$v =   $this->pd->save($payment_details_array);
						
						
						endif;
					
					
					if($reconcilitation_detail['re_dctype'] == 2): //debit action
					
					
					
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
	}