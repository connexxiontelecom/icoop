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
	use App\Models\WithdrawModel;
	use App\Models\PolicyConfigModel;
	use App\Models\CoopBankModel;
	
	
	class Receipt extends BaseController
	{
		public function __construct(){
			$this->pg = new PayrollGroups();
			$this->contribution_type = new ContributionTypeModel();
			$this->cooperator = new Cooperators();
			$this->temp_pd = new TempPaymentsModel();
			$this->pd = new PaymentDetailsModel();
			$this->exception = new ExceptionModel();
			$this->withdraw = new WithdrawModel();
			$this->policy = new PolicyConfigModel();
			$this->cb = new CoopBankModel();
			
		}
		
		public function new_receipt(){
			
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['cbs'] = $this->cb->getCoopBanks();
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/receipt/new_receipt', $data);
			
			endif;
			
			if($method == 'post'):
				
				
				$this->validator->setRules( [
					'withdraw_staff_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter Staff ID'
						]
					],
					
					'withdraw_ct_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a Contribution Type'
						]
					],
					
					'withdraw_amount'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],
				
				
				
				]);
				if ($this->validator->withRequest($this->request)->run()):
					$withdraw_staff_id = $_POST['withdraw_staff_id'];
					$withdraw_staff_id = substr($withdraw_staff_id, 0, strpos($withdraw_staff_id, ','));
					
					$check_pending_withdrawal = $this->withdraw->where(['withdraw_status <'=> 3, 'disburse' => 0, 'withdraw_staff_id' => $withdraw_staff_id])->findAll();
					
					if(empty($check_pending_withdrawal)):
						
						$file = $this->request->getFile('withdraw_file');
						
						if(!empty($file)):
							
							if($file->isValid() && !$file->hasMoved()):
								
								$extension = $file->guessExtension();
								$extension = strtolower($extension);
								
								if($extension == 'pdf'):
									
									$file_name = $file->getRandomName();
									
									$_POST['withdraw_doc'] = $file_name;
									
									$file->move('.uploads/withdrawals', $file_name);
									
									$_POST['withdraw_amount'] = (float)str_replace(',', '', $_POST['withdraw_amount']);
									
									$withdraw_balance = $_POST['withdraw_balance'];
									$withdraw_amount = $_POST['withdraw_amount'];
									
									if($withdraw_amount > $withdraw_balance):
										$data = array(
											'msg' => 'Insufficient Balance',
											'type' => 'error',
											'location' => base_url('new_withdraw')
										
										);
										
										return view('pages/sweet-alert', $data);
									
									
									else:
										
										$_POST['withdraw_charges'] = ($_POST['withdraw_charge']/100)*$withdraw_amount;
										unset($_POST['withdraw_charge']);
										unset($_POST['withdraw_balance']);
										$_POST['withdraw_status'] = 0;
										
										$_POST['withdraw_staff_id'] = $withdraw_staff_id;
										$v =  $this->withdraw->save($_POST);
										
										if($v):
											
											$data = array(
												'msg' => 'Action Successful',
												'type' => 'success',
												'location' => base_url('new_withdraw')
											
											);
											return view('pages/sweet-alert', $data);
										
										else:
											$data = array(
												'msg' => 'An Error Occured',
												'type' => 'error',
												'location' => base_url('new_withdraw')
											
											);
											return view('pages/sweet-alert', $data);
										
										
										endif;
									
									endif;
								
								
								else:
									
									$data = array(
										'msg' => 'Only PDF files are allowed',
										'type' => 'error',
										'location' => base_url('new_withdraw')
									
									);
									
									echo view('pages/sweet-alert', $data);
								
								endif;
							
							
							else:
								$withdraw_balance = $_POST['withdraw_balance'];
								$withdraw_amount = $_POST['withdraw_amount'];
								
								if($withdraw_amount > $withdraw_balance):
									$data = array(
										'msg' => 'Insufficient Balance',
										'type' => 'error',
										'location' => base_url('new_withdraw')
									
									);
									
									return view('pages/sweet-alert', $data);
								
								
								else:
									
									$_POST['withdraw_charges'] = ($_POST['withdraw_charge']/100)*$withdraw_amount;
									unset($_POST['withdraw_charge']);
									unset($_POST['withdraw_balance']);
									$_POST['withdraw_status'] = 0;
//					                   $withdraw_staff_id = $_POST['withdraw_staff_id'];
//					                   $withdraw_staff_id = substr($withdraw_staff_id, 0, strpos($withdraw_staff_id, ','));
									$_POST['withdraw_staff_id'] = $withdraw_staff_id;
									$_POST['withdraw_narration'] = 'Withdraw from Savings';
									$v =  $this->withdraw->save($_POST);
									
									if($v):
										
										$data = array(
											'msg' => 'Action Successful',
											'type' => 'success',
											'location' => base_url('new_withdraw')
										
										);
										return view('pages/sweet-alert', $data);
									
									else:
										$data = array(
											'msg' => 'An Error Occured',
											'type' => 'error',
											'location' => base_url('new_withdraw')
										
										);
										return view('pages/sweet-alert', $data);
									
									
									endif;
								
								endif;
							
							endif;
						
						
						
						endif;
					
					
					else:
						
						$data = array(
							'msg' => 'Staff has Pending Withdrawal',
							'type' => 'error',
							'location' => base_url('new_withdraw')
						
						);
						
						return view('pages/sweet-alert', $data);
					
					
					endif;
				
				else:
					
					$arr = $this->validator->getErrors();
					
					$data = array(
						'msg' => implode(", ", $arr),
						'type' => 'error',
						'location' => base_url('new_withdraw')
					
					);
					
					echo view('pages/sweet-alert', $data);
				
				
				endif;








//            $data['cts'] = $this->contribution_type->findAll();
//            $username = $this->session->user_username;
//            $this->authenticate_user($username, 'pages/withdraw/new_withdraw', $data);
			
			endif;
		}
	}
