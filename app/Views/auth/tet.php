<?php
	
	if($method == 'get'):
		//did lots of array manipulation here, before editing please ensure you are smart.
		//$jtms = $this->jtm->where(['jtm_status' => 0])->findAll();
		$jtms = $this->jtm->get_receipts(1);
		$x = 0;
		$jtm_data = array();
		foreach ($jtms as $jtm):
			
			$jtm_id = $jtm['jtm_id'];
			
			$jtds = $this->jtd->where(['jtd_jtm_id' => $jtm_id])->findAll();
			
			$y = 0;
			$jtd_data = array();
			foreach ($jtds as $jtd):
				if($jtd['jtd_type'] == 1): //loan
					$loan_id = $jtd['jtd_target'];
					$loan_data = $this->loan->get_loan($loan_id);
					$jtd_data['target'][$y] = $jtd + $loan_data;
				endif;
				if($jtd['jtd_type'] == 2): //savings
					$ct_id = $jtd['jtd_target'];
					$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
					$jtd_data['target'][$y] = $jtd + $ct_data;
				endif;
				
				$y++;
			endforeach;
			
			$jtm_data[$x] = $jtm + $jtd_data;
			
			$x++;
		endforeach;
		
		$data['jtms'] = $jtm_data;
		
		//dd($jtm_data);
		
		$username = $this->session->user_username;
		$this->authenticate_user($username, 'pages/receipt/approve_receipt', $data);
	
	endif;
	
	if($method == 'post'):
		
		$jtm_status = $_POST['jtm_status'];
		
		if($jtm_status == 2):
			
			$jtm['jtm_status'] = $jtm_status;
			$jtm['jtm_approve_comment'] = $_POST['jtm_approve_comment'];
			$jtm['jtm_approve_date'] = date('Y-m-d');
			$jtm['jtm_approve_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
			$jtm['jtm_id'] = $_POST['jtm_id'];
			$jtm_id = $jtm['jtm_id'];
			
			$check = $this->jtm->save($jtm);
			
			$r_m = $this->jtm->where(['jtm_id' => $jtm_id])->first();
			$staff_id = $r_m['jtm_staff_id'];
			$ref_code = time();
			$jtds = $this->jtd->where(['jtd_jtm_id' => $jtm_id])->findAll();
			$cooperator = $this->cooperator->get_cooperator_staff_id($staff_id);
			
			
			foreach ($jtds as $jtd):
				if($jtd['jtd_type'] == 1): //loan
					$loan_id = $jtd['jtd_target'];
					
					
					
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
					
					if($interest_unpaid >= $jtd['jtd_amount']):
						
						
						$mi = $jtd['jtd_amount'];
						$mpr = 0;
					
					else:
						
						$mi =$interest_unpaid;
						$mpr = $jtd['jtd_amount'] - $interest_unpaid;
					
					endif;
					
					$loan_repayment = array(
						'lr_staff_id' => $staff_id,
						'lr_loan_id' => $loan_id,
						'lr_month' => date('n'),
						'lr_year' => date('Y'),
						'lr_amount' => $jtd['jtd_amount'],
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
						'cr_amount' => $jtd['jtd_amount'],
						'ref_no' =>$ref_code,
						'bank' => $account['bank'],
						'ob' => 0,
						'posted' => 1,
						'created_at' => date('Y-m-d'),
					);
					$this->gl->save($bankGl);
					
					$coop_bank = $this->cb->where('coop_bank_id', $r_m['jtm_coop_bank'])->first();
					$account = $this->coa->where('glcode', $coop_bank['glcode'])->first();
					$bankGl = array(
						'glcode' => $coop_bank['glcode'],
						'posted_by' => $this->session->user_username,
						'narration' => 'Loan repayment from external receipt',
						'dr_amount' => $jtd['jtd_amount'],
						'cr_amount' => 0,
						'ref_no' =>$ref_code,
						'bank' => $account['bank'],
						'ob' => 0,
						'posted' => 1,
						'created_at' => date('Y-m-d'),
					);
					$this->gl->save($bankGl);
				
				
				endif;
				if($jtd['jtd_type'] == 2): //savings
					$ct_id = $jtd['jtd_target'];
					$ct_data = $this->contribution_type->where(['contribution_type_id' => $ct_id])->first();
					
					$payment_details_array = array(
						'pd_staff_id' => $staff_id,
						'pd_transaction_date' => date('Y-m-d'),
						'pd_narration' => 'External receipt contribution',
						'pd_amount' => $jtd['jtd_amount'],
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
						'cr_amount' => $jtd['jtd_amount'],
						'ref_no' =>$ref_code,
						'bank' => $account['bank'],
						'ob' => 0,
						'posted' => 1,
						'created_at' =>  date('Y-m-d'),
					);
					$this->gl->save($bankGl);
					
					
					//debit bank gl
					// bank gl_code should be entered here
					
					$coop_bank = $this->cb->where('coop_bank_id', $r_m['jtm_coop_bank'])->first();
					$account = $this->coa->where('glcode', $coop_bank['glcode'])->first();
					
					$bankGl = array(
						'glcode' => $coop_bank['glcode'],
						'posted_by' => $this->session->user_username,
						'narration' => 'External receipt contribution',
						'dr_amount' => $jtd['jtd_amount'],
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


//							$jtd_data['target'][$y] = $jtd + $ct_data;
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
		
		
		if($jtm_status == 3):
			$jtm['jtm_status'] = $jtm_status;
			$jtm['jtm_discard_comment'] = $_POST['jtm_discard_comment'];
			$jtm['jtm_discard_date'] = date('Y-m-d');
			$jtm['jtm_discard_by'] = $this->session->user_first_name." ".$this->session->user_last_name;
			$jtm['jtm_id'] = $_POST['jtm_id'];
			
			$check = $this->jtm->save($jtm);
			
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

?>
