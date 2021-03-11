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
	use App\Models\ReceiptMasterModel;
	use App\Models\ReceiptDetailModel;
	use App\Models\LoanModel;
	use App\Models\LoanRepaymentModel;
	use App\Models\CoaModel;
	use App\Models\GlModel;
	

	
	
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
			$this->rm = new ReceiptMasterModel();
			$this->rd = new ReceiptDetailModel();
			$this->loan = new LoanModel();
			$this->cooperator = new Cooperators();
			$this->lr = new LoanRepaymentModel();
			$this->coa = new CoaModel();
			$this->gl = new GlModel();
			
			
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
					'staff_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter a Staff ID'
						]
					],

					'date'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a Contribution Type'
						]
					],

					'master_amount'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],
					
					'payment_method'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],


				]);
				
		if ($this->validator->withRequest($this->request)->run()):
				
				$rm['rm_staff_id'] = substr($_POST['staff_id'], 0, strpos($_POST['staff_id'], ','));
				$rm['rm_date'] = $_POST['date'];
				$rm['rm_amount'] = str_replace(',', '', $_POST['master_amount']);
				$master_amount = str_replace(',', '', $_POST['master_amount']);
				$rm['rm_payment_method'] = $_POST['payment_method'];
				$rm['rm_coop_bank'] = $_POST['coop_bank'];
				$rm['rm_status'] = 0;
				$x = 0;
				$total_amount = 0;
				$rm['rm_a_date'] = date("Y-m-d");
				$rm['rm_by'] = $this->session->user_username;
				$payment_amounts = $_POST['payment_amount'];
				foreach ($payment_amounts as $payment_amount):
					$payment_amount= str_replace(',', '', $payment_amount);
					
					$total_amount = $total_amount + $payment_amount;
					
				endforeach;
				
				if($master_amount !== 0):
					
					if($master_amount == $total_amount):
						$payment_type = $_POST['payment_type'];
						$target = $_POST['target'];
						
						// do the computation here
						//if any of this computation fails, it means  someone tampered the js on the frontend
						
						$rm_id = $this->rm->insert($rm);
						
						foreach ($payment_amounts as $payment_amount):
							
							$payment_amount= str_replace(',', '', $payment_amount);
							
							$rd['rd_rm_id'] = $rm_id;
							$rd['rd_amount'] = $payment_amount;
							$rd['rd_type'] = $payment_type[$x];
							$rd['rd_target'] = $target[$x];
							
							$this->rd->save($rd);
							
						$x++;
						
						endforeach;
						
						if($x == count($payment_amounts)):
							
							$data = array(
								'msg' => 'Action Successful',
								'type' => 'success',
								'location' => base_url('new_receipt')
											);
						return view('pages/sweet-alert', $data);
							else:
							$data = array(
								'msg' => 'An Error Occurred',
								'type' => 'error',
								'location' => base_url('new_receipt')
							);
							return view('pages/sweet-alert', $data);
								
								endif;
						
						elseif($master_amount > $total_amount):
						
							//master amount cannot be greater
							
							$data = array(
								'msg' => 'master was greater',
								'type' => 'error',
								'location' => base_url('new_receipt')
							);
							return view('pages/sweet-alert', $data);
						
						
						elseif ($master_amount < $total_amount):
							//master amount cannot be less
							
							$data = array(
								'msg' => 'master was less',
								'type' => 'error',
								'location' => base_url('new_receipt')
							);
							return view('pages/sweet-alert', $data);
							
							endif;
					
					
					else:
						//master amount cannot be zero
						$data = array(
							'msg' => 'master was zero',
							'type' => 'error',
							'location' => base_url('new_receipt')
						);
						return view('pages/sweet-alert', $data);
						
						endif;
		
			else:
					$arr = $this->validator->getErrors();

					$data = array(
						'msg' => implode(", ", $arr),
						'type' => 'error',
						'location' => base_url('new_receipt')

					);

					echo view('pages/sweet-alert', $data);

				endif;
				
			endif;
		}
		
		public  function verify_receipt() {
			
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				//did lots of array manipulation here, before editing please ensure you are smart.
				//$rms = $this->rm->where(['rm_status' => 0])->findAll();
				$rms = $this->rm->get_receipts(0);
				$x = 0;
				$rm_data = array();
				foreach ($rms as $rm):
					
					$rm_id = $rm['rm_id'];
					
					$rds = $this->rd->where(['rd_rm_id' => $rm_id])->findAll();
					
					$y = 0;
					$rd_data = array();
					foreach ($rds as $rd):
						if($rd['rd_type'] == 1): //loan
							$loan_id = $rd['rd_target'];
							$loan_data = $this->loan->get_loan($loan_id);
							$rd_data['target'][$y] = $rd + $loan_data;
						endif;
						if($rd['rd_type'] == 2): //savings
							$ct_id = $rd['rd_target'];
							$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							$rd_data['target'][$y] = $rd + $ct_data;
						endif;
						
						$y++;
					endforeach;
					
					$rm_data[$x] = $rm + $rd_data;
					
					$x++;
				endforeach;
				
				$data['rms'] = $rm_data;
				
				//dd($rm_data);
				
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/receipt/verify_receipt', $data);
			
			endif;
			
			if($method == 'post'):
				
				$rm_status = $_POST['rm_status'];
			
			if($rm_status == 1):
				
				$rm['rm_status'] = $rm_status;
				$rm['rm_verify_comment'] = $_POST['rm_verify_comment'];
				$rm['rm_verify_date'] = date('Y-m-d');
				$rm['rm_verify_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
				$rm['rm_id'] = $_POST['rm_id'];
				
				$check = $this->rm->save($rm);
				
				if($check):
					$data = array(
						'msg' => 'Receipt Verified',
						'type' => 'success',
						'location' => base_url('verify_receipt')
					);
					return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('verify_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				
				endif;
			
			
			if($rm_status == 3):
				
				$rm['rm_status'] = $rm_status;
				$rm['rm_discard_comment'] = $_POST['rm_discard_comment'];
				$rm['rm_discard_date'] = date('Y-m-d');
				$rm['rm_discard_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
				$rm['rm_id'] = $_POST['rm_id'];
				
				$check = $this->rm->save($rm);
				
				if($check):
					$data = array(
						'msg' => 'Receipt Disqualified',
						'type' => 'success',
						'location' => base_url('verify_receipt')
					);
					return view('pages/sweet-alert', $data);
				
				else:
					
					$data = array(
						'msg' => 'An error Occurred',
						'type' => 'error',
						'location' => base_url('verify_receipt')
					);
					return view('pages/sweet-alert', $data);
				endif;
			
			endif;
			
			
			endif;
		  
		}
		
		
		public  function approve_receipt() {
			
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				//did lots of array manipulation here, before editing please ensure you are smart.
				//$rms = $this->rm->where(['rm_status' => 0])->findAll();
				$rms = $this->rm->get_receipts(1);
				$x = 0;
				$rm_data = array();
				foreach ($rms as $rm):
					
					$rm_id = $rm['rm_id'];
					
					$rds = $this->rd->where(['rd_rm_id' => $rm_id])->findAll();
					
					$y = 0;
					$rd_data = array();
					foreach ($rds as $rd):
						if($rd['rd_type'] == 1): //loan
							$loan_id = $rd['rd_target'];
							$loan_data = $this->loan->get_loan($loan_id);
							$rd_data['target'][$y] = $rd + $loan_data;
						endif;
						if($rd['rd_type'] == 2): //savings
							$ct_id = $rd['rd_target'];
							$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							$rd_data['target'][$y] = $rd + $ct_data;
						endif;
						
						$y++;
					endforeach;
					
					$rm_data[$x] = $rm + $rd_data;
					
					$x++;
				endforeach;
				
				$data['rms'] = $rm_data;
				
				//dd($rm_data);
				
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/receipt/approve_receipt', $data);
			
			endif;
			
			if($method == 'post'):
				
				$rm_status = $_POST['rm_status'];
				
				if($rm_status == 2):
					
					$rm['rm_status'] = $rm_status;
					$rm['rm_approve_comment'] = $_POST['rm_approve_comment'];
					$rm['rm_approve_date'] = date('Y-m-d');
					$rm['rm_approve_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
					$rm['rm_id'] = $_POST['rm_id'];
					$rm_id = $rm['rm_id'];
					
					$check = $this->rm->save($rm);
					
					$r_m = $this->rm->where(['rm_id' => $rm_id])->first();
					$staff_id = $r_m['rm_staff_id'];
					$ref_code = time();
					$rds = $this->rd->where(['rd_rm_id' => $rm_id])->findAll();
					$cooperator = $this->cooperator->get_cooperator_staff_id($staff_id);
					
					
					foreach ($rds as $rd):
						if($rd['rd_type'] == 1): //loan
							$loan_id = $rd['rd_target'];
							
							
							
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
							
							if($interest_unpaid >= $rd['rd_amount']):
								
								
								$mi = $rd['rd_amount'];
								$mpr = 0;
							
							else:
								
								$mi =$interest_unpaid;
								$mpr = $rd['rd_amount'] - $interest_unpaid;
							
							endif;
							
							$loan_repayment = array(
								'lr_staff_id' => $staff_id,
								'lr_loan_id' => $loan_id,
								'lr_month' => date('n'),
								'lr_year' => date('Y'),
								'lr_amount' => $rd['rd_amount'],
								'lr_dctype' => 1,
								'lr_ref' => $ref_code,
								'lr_narration' => 'Loan repayment from external receipt',
								'lr_mi' => $mi,
								'lr_mpr' => $mpr,
								'lr_interest' => 0,
								'lr_date' => date('Y-m-d'),
							);


							$v =   $this->lr->save($loan_repayment);
							$loan_s = $this->loan->get_loan($loan_id);
							
							$account = $this->coa->where('glcode', $loan_s['loan_gl_account_no'])->first();
							$bankGl = array(
								'glcode' => $loan_s['loan_gl_account_no'],
								'posted_by' => $this->session->user_username,
								'narration' => 'Loan repayment from external receipt',
								'dr_amount' => 0,
								'cr_amount' => $rd['rd_amount'],
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' => date('Y-m-d'),
							);
							$this->gl->save($bankGl);
							
							$coop_bank = $this->cb->where('coop_bank_id', $r_m['rm_coop_bank'])->first();
							$account = $this->coa->where('glcode', $coop_bank['glcode'])->first();
							$bankGl = array(
								'glcode' => $coop_bank['glcode'],
								'posted_by' => $this->session->user_username,
								'narration' => 'Loan repayment from external receipt',
								'dr_amount' => $rd['rd_amount'],
								'cr_amount' => 0,
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' => date('Y-m-d'),
							);
							$this->gl->save($bankGl);
							
							
						endif;
						if($rd['rd_type'] == 2): //savings
							$ct_id = $rd['rd_target'];
							$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							
							$payment_details_array = array(
								'pd_staff_id' => $staff_id,
								'pd_transaction_date' => date('Y-m-d'),
								'pd_narration' => 'External receipt contribution',
								'pd_amount' => $rd['rd_amount'],
								'pd_drcrtype' => 1,
								'pd_ct_id' => $ct_id,
								'pd_pg_id' => $cooperator->cooperator_payroll_group_id,
								'pd_ref_code' => $ref_code,
								'pd_month' => date('n'),
								'pd_year' => date('Y')
							);
							
							
							$v =   $this->pd->save($payment_details_array);
							
							
							
							$wt = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							
							
							//cr contribution type gl amount
							$account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();
							$bankGl = array(
								'glcode' => $wt['contribution_type_glcode'],
								'posted_by' => $this->session->user_username,
								'narration' => 'External receipt contribution',
								'dr_amount' => 0,
								'cr_amount' => $rd['rd_amount'],
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' =>  date('Y-m-d'),
							);
							$this->gl->save($bankGl);
							
							
							//debit bank gl
							// bank gl_code should be entered here
							
							$coop_bank = $this->cb->where('coop_bank_id', $r_m['rm_coop_bank'])->first();
							$account = $this->coa->where('glcode', $coop_bank['glcode'])->first();
							
							$bankGl = array(
								'glcode' => $coop_bank['glcode'],
								'posted_by' => $this->session->user_username,
								'narration' => 'External receipt contribution',
								'dr_amount' => $rd['rd_amount'],
								'cr_amount' => 0,
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' =>  date('Y-m-d'),
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
								$loan_amount = $loan_ledger->amount;
								
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
							
							
//							$rd_data['target'][$y] = $rd + $ct_data;
						endif;
						
						
					endforeach;
					
					if($v):
						$data = array(
							'msg' => 'Receipt Approved',
							'type' => 'success',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				
				endif;
				
				
				if($rm_status == 3):
					$rm['rm_status'] = $rm_status;
					$rm['rm_discard_comment'] = $_POST['rm_discard_comment'];
					$rm['rm_discard_date'] = date('Y-m-d');
					$rm['rm_discard_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
					$rm['rm_id'] = $_POST['rm_id'];
					
					$check = $this->rm->save($rm);
					
					if($check):
						$data = array(
							'msg' => 'Receipt Disqualified',
							'type' => 'success',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				endif;
			
			
			endif;
			
		}
		
		public function new_transfer(){
			
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				
				$data['policy_configs'] = $this->policy->first();
				$data['cts'] = $this->contribution_type->findAll();
				$data['cbs'] = $this->cb->getCoopBanks();
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/receipt/new_transfer', $data);
			
			endif;
			
			if($method == 'post'):
				
				
				$this->validator->setRules( [
					'staff_id'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter a Staff ID'
						]
					],
					
					'date'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Select a Contribution Type'
						]
					],
					
					'master_amount'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],
					
					'payment_method'=>[
						'rules'=>'required',
						'errors'=>[
							'required'=>'Enter an amount'
						]
					],
				
				
				]);
				
				if ($this->validator->withRequest($this->request)->run()):
					
					$rm['rm_staff_id'] = substr($_POST['staff_id'], 0, strpos($_POST['staff_id'], ','));
					$rm['rm_date'] = $_POST['date'];
					$rm['rm_amount'] = str_replace(',', '', $_POST['master_amount']);
					$master_amount = str_replace(',', '', $_POST['master_amount']);
					$rm['rm_payment_method'] = $_POST['payment_method'];
					$rm['rm_coop_bank'] = $_POST['coop_bank'];
					$rm['rm_status'] = 0;
					$x = 0;
					$total_amount = 0;
					$rm['rm_a_date'] = date("Y-m-d");
					$rm['rm_by'] = $this->session->user_username;
					$payment_amounts = $_POST['payment_amount'];
					foreach ($payment_amounts as $payment_amount):
						$payment_amount= str_replace(',', '', $payment_amount);
						
						$total_amount = $total_amount + $payment_amount;
					
					endforeach;
					
					if($master_amount !== 0):
						
						if($master_amount == $total_amount):
							$payment_type = $_POST['payment_type'];
							$target = $_POST['target'];
							
							// do the computation here
							//if any of this computation fails, it means  someone tampered the js on the frontend
							
							$rm_id = $this->rm->insert($rm);
							
							foreach ($payment_amounts as $payment_amount):
								
								$payment_amount= str_replace(',', '', $payment_amount);
								
								$rd['rd_rm_id'] = $rm_id;
								$rd['rd_amount'] = $payment_amount;
								$rd['rd_type'] = $payment_type[$x];
								$rd['rd_target'] = $target[$x];
								
								$this->rd->save($rd);
								
								$x++;
							
							endforeach;
							
							if($x == count($payment_amounts)):
								
								$data = array(
									'msg' => 'Action Successful',
									'type' => 'success',
									'location' => base_url('new_receipt')
								);
								return view('pages/sweet-alert', $data);
							else:
								$data = array(
									'msg' => 'An Error Occurred',
									'type' => 'error',
									'location' => base_url('new_receipt')
								);
								return view('pages/sweet-alert', $data);
							
							endif;
						
						elseif($master_amount > $total_amount):
							
							//master amount cannot be greater
							
							$data = array(
								'msg' => 'master was greater',
								'type' => 'error',
								'location' => base_url('new_receipt')
							);
							return view('pages/sweet-alert', $data);
						
						
						elseif ($master_amount < $total_amount):
							//master amount cannot be less
							
							$data = array(
								'msg' => 'master was less',
								'type' => 'error',
								'location' => base_url('new_receipt')
							);
							return view('pages/sweet-alert', $data);
						
						endif;
					
					
					else:
						//master amount cannot be zero
						$data = array(
							'msg' => 'master was zero',
							'type' => 'error',
							'location' => base_url('new_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					endif;
				
				else:
					$arr = $this->validator->getErrors();
					
					$data = array(
						'msg' => implode(", ", $arr),
						'type' => 'error',
						'location' => base_url('new_receipt')
					
					);
					
					echo view('pages/sweet-alert', $data);
				
				endif;
			
			endif;
		}
		
		public  function verify_transfer() {
			
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				//did lots of array manipulation here, before editing please ensure you are smart.
				//$rms = $this->rm->where(['rm_status' => 0])->findAll();
				$rms = $this->rm->get_receipts(0);
				$x = 0;
				$rm_data = array();
				foreach ($rms as $rm):
					
					$rm_id = $rm['rm_id'];
					
					$rds = $this->rd->where(['rd_rm_id' => $rm_id])->findAll();
					
					$y = 0;
					$rd_data = array();
					foreach ($rds as $rd):
						if($rd['rd_type'] == 1): //loan
							$loan_id = $rd['rd_target'];
							$loan_data = $this->loan->get_loan($loan_id);
							$rd_data['target'][$y] = $rd + $loan_data;
						endif;
						if($rd['rd_type'] == 2): //savings
							$ct_id = $rd['rd_target'];
							$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							$rd_data['target'][$y] = $rd + $ct_data;
						endif;
						
						$y++;
					endforeach;
					
					$rm_data[$x] = $rm + $rd_data;
					
					$x++;
				endforeach;
				
				$data['rms'] = $rm_data;
				
				//dd($rm_data);
				
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/receipt/verify_receipt', $data);
			
			endif;
			
			if($method == 'post'):
				
				$rm_status = $_POST['rm_status'];
				
				if($rm_status == 1):
					
					$rm['rm_status'] = $rm_status;
					$rm['rm_verify_comment'] = $_POST['rm_verify_comment'];
					$rm['rm_verify_date'] = date('Y-m-d');
					$rm['rm_verify_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
					$rm['rm_id'] = $_POST['rm_id'];
					
					$check = $this->rm->save($rm);
					
					if($check):
						$data = array(
							'msg' => 'Receipt Verified',
							'type' => 'success',
							'location' => base_url('verify_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('verify_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				
				endif;
				
				
				if($rm_status == 3):
					
					$rm['rm_status'] = $rm_status;
					$rm['rm_discard_comment'] = $_POST['rm_discard_comment'];
					$rm['rm_discard_date'] = date('Y-m-d');
					$rm['rm_discard_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
					$rm['rm_id'] = $_POST['rm_id'];
					
					$check = $this->rm->save($rm);
					
					if($check):
						$data = array(
							'msg' => 'Receipt Disqualified',
							'type' => 'success',
							'location' => base_url('verify_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('verify_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				endif;
			
			
			endif;
			
		}
		
		
		public  function approve_transfer() {
			
			$method = $this->request->getMethod();
			
			if($method == 'get'):
				//did lots of array manipulation here, before editing please ensure you are smart.
				//$rms = $this->rm->where(['rm_status' => 0])->findAll();
				$rms = $this->rm->get_receipts(1);
				$x = 0;
				$rm_data = array();
				foreach ($rms as $rm):
					
					$rm_id = $rm['rm_id'];
					
					$rds = $this->rd->where(['rd_rm_id' => $rm_id])->findAll();
					
					$y = 0;
					$rd_data = array();
					foreach ($rds as $rd):
						if($rd['rd_type'] == 1): //loan
							$loan_id = $rd['rd_target'];
							$loan_data = $this->loan->get_loan($loan_id);
							$rd_data['target'][$y] = $rd + $loan_data;
						endif;
						if($rd['rd_type'] == 2): //savings
							$ct_id = $rd['rd_target'];
							$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							$rd_data['target'][$y] = $rd + $ct_data;
						endif;
						
						$y++;
					endforeach;
					
					$rm_data[$x] = $rm + $rd_data;
					
					$x++;
				endforeach;
				
				$data['rms'] = $rm_data;
				
				//dd($rm_data);
				
				$username = $this->session->user_username;
				$this->authenticate_user($username, 'pages/receipt/approve_receipt', $data);
			
			endif;
			
			if($method == 'post'):
				
				$rm_status = $_POST['rm_status'];
				
				if($rm_status == 2):
					
					$rm['rm_status'] = $rm_status;
					$rm['rm_approve_comment'] = $_POST['rm_approve_comment'];
					$rm['rm_approve_date'] = date('Y-m-d');
					$rm['rm_approve_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
					$rm['rm_id'] = $_POST['rm_id'];
					$rm_id = $rm['rm_id'];
					
					$check = $this->rm->save($rm);
					
					$r_m = $this->rm->where(['rm_id' => $rm_id])->first();
					$staff_id = $r_m['rm_staff_id'];
					$ref_code = time();
					$rds = $this->rd->where(['rd_rm_id' => $rm_id])->findAll();
					$cooperator = $this->cooperator->get_cooperator_staff_id($staff_id);
					
					
					foreach ($rds as $rd):
						if($rd['rd_type'] == 1): //loan
							$loan_id = $rd['rd_target'];
							
							
							
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
							
							if($interest_unpaid >= $rd['rd_amount']):
								
								
								$mi = $rd['rd_amount'];
								$mpr = 0;
							
							else:
								
								$mi =$interest_unpaid;
								$mpr = $rd['rd_amount'] - $interest_unpaid;
							
							endif;
							
							$loan_repayment = array(
								'lr_staff_id' => $staff_id,
								'lr_loan_id' => $loan_id,
								'lr_month' => date('n'),
								'lr_year' => date('Y'),
								'lr_amount' => $rd['rd_amount'],
								'lr_dctype' => 1,
								'lr_ref' => $ref_code,
								'lr_narration' => 'Loan repayment from external receipt',
								'lr_mi' => $mi,
								'lr_mpr' => $mpr,
								'lr_interest' => 0,
								'lr_date' => date('Y-m-d'),
							);
							
							
							$v =   $this->lr->save($loan_repayment);
							$loan_s = $this->loan->get_loan($loan_id);
							
							$account = $this->coa->where('glcode', $loan_s['loan_gl_account_no'])->first();
							$bankGl = array(
								'glcode' => $loan_s['loan_gl_account_no'],
								'posted_by' => $this->session->user_username,
								'narration' => 'Loan repayment from external receipt',
								'dr_amount' => 0,
								'cr_amount' => $rd['rd_amount'],
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' => date('Y-m-d'),
							);
							$this->gl->save($bankGl);
							
							$coop_bank = $this->cb->where('coop_bank_id', $r_m['rm_coop_bank'])->first();
							$account = $this->coa->where('glcode', $coop_bank['glcode'])->first();
							$bankGl = array(
								'glcode' => $coop_bank['glcode'],
								'posted_by' => $this->session->user_username,
								'narration' => 'Loan repayment from external receipt',
								'dr_amount' => $rd['rd_amount'],
								'cr_amount' => 0,
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' => date('Y-m-d'),
							);
							$this->gl->save($bankGl);
						
						
						endif;
						if($rd['rd_type'] == 2): //savings
							$ct_id = $rd['rd_target'];
							$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							
							$payment_details_array = array(
								'pd_staff_id' => $staff_id,
								'pd_transaction_date' => date('Y-m-d'),
								'pd_narration' => 'External receipt contribution',
								'pd_amount' => $rd['rd_amount'],
								'pd_drcrtype' => 1,
								'pd_ct_id' => $ct_id,
								'pd_pg_id' => $cooperator->cooperator_payroll_group_id,
								'pd_ref_code' => $ref_code,
								'pd_month' => date('n'),
								'pd_year' => date('Y')
							);
							
							
							$v =   $this->pd->save($payment_details_array);
							
							
							
							$wt = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
							
							
							//cr contribution type gl amount
							$account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();
							$bankGl = array(
								'glcode' => $wt['contribution_type_glcode'],
								'posted_by' => $this->session->user_username,
								'narration' => 'External receipt contribution',
								'dr_amount' => 0,
								'cr_amount' => $rd['rd_amount'],
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' =>  date('Y-m-d'),
							);
							$this->gl->save($bankGl);
							
							
							//debit bank gl
							// bank gl_code should be entered here
							
							$coop_bank = $this->cb->where('coop_bank_id', $r_m['rm_coop_bank'])->first();
							$account = $this->coa->where('glcode', $coop_bank['glcode'])->first();
							
							$bankGl = array(
								'glcode' => $coop_bank['glcode'],
								'posted_by' => $this->session->user_username,
								'narration' => 'External receipt contribution',
								'dr_amount' => $rd['rd_amount'],
								'cr_amount' => 0,
								'ref_no' =>$ref_code,
								'bank' => $account['bank'],
								'ob' => 0,
								'posted' => 1,
								'created_at' =>  date('Y-m-d'),
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
								$loan_amount = $loan_ledger->amount;
								
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


//							$rd_data['target'][$y] = $rd + $ct_data;
						endif;
					
					
					endforeach;
					
					if($v):
						$data = array(
							'msg' => 'Receipt Approved',
							'type' => 'success',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				
				endif;
				
				
				if($rm_status == 3):
					$rm['rm_status'] = $rm_status;
					$rm['rm_discard_comment'] = $_POST['rm_discard_comment'];
					$rm['rm_discard_date'] = date('Y-m-d');
					$rm['rm_discard_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
					$rm['rm_id'] = $_POST['rm_id'];
					
					$check = $this->rm->save($rm);
					
					if($check):
						$data = array(
							'msg' => 'Receipt Disqualified',
							'type' => 'success',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					
					else:
						
						$data = array(
							'msg' => 'An error Occurred',
							'type' => 'error',
							'location' => base_url('approve_receipt')
						);
						return view('pages/sweet-alert', $data);
					endif;
				
				endif;
			
			
			endif;
			
		}
	}
