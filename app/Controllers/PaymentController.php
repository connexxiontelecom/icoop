<?php namespace App\Controllers;
use App\Models\LoanApplicationModel; 
use \App\Models\Cooperators;
use \App\Models\UserModel;
use \App\Models\LoanModel;
use \App\Models\LoanSetupModel;
use \App\Models\CoopBankModel;
use \App\Models\WithdrawModel;
use \App\Models\ScheduleMasterModel;
use \App\Models\ScheduleMasterDetailModel;
use \App\Models\PaymentDetailsModel;
use \App\Models\PaymentCartModel;
use \App\Models\LoanRepaymentModel;
use App\Models\CoaModel; 
use App\Models\ThirdPartyPaymentEntryModel; 
use App\Models\EntryPaymentMasterModel; 
use App\Models\EntryPaymentDetailModel; 
use App\Models\GlModel;
use App\Models\ContributionTypeModel;
use App\Models\Banks;

class PaymentController extends BaseController
{

    public function __construct(){
        $this->session = session();
		$this->loanapp = new LoanApplicationModel();
		$this->coop = new Cooperators();
        $this->loansetup = new LoanSetupModel();
        $this->coopbank = new CoopBankModel();
        $this->banks = new Banks();
        $this->schedulemaster = new ScheduleMasterModel();
        $this->schedulemasterdetail = new ScheduleMasterDetailModel();
        $this->loan = new LoanModel();
        $this->withdraw = new WithdrawModel();
        $this->user = new UserModel();
        $this->paymentdetail = new PaymentDetailsModel();
        $this->paymentcart = new PaymentCartModel();
        $this->loanrepayment = new LoanRepaymentModel();
        $this->coa = new CoaModel();
        $this->thirpartypaymententry = new ThirdPartyPaymentEntryModel();
        $this->entrypaymentmaster = new EntryPaymentMasterModel();
        $this->entrypaymentdetail = new EntryPaymentDetailModel();
        $this->gl = new GlModel();
        $this->session = session();
        $this->ct = new ContributionTypeModel();
        $this->coa = new CoaModel();
    }



    public function newPaymentSchedule(){
         $data = [];
         #approved loans
         $approved_loans = $this->loan->getApprovedLoans();
         $approved_withdraw = $this->withdraw->getApprovedWithdraws();
         #cart
         $cart = $this->loan->getItemsInCart();
         $withdraw_cart = $this->withdraw->getWithdrawItemsInCart();
        #withdraw request
        $withdraws = $this->withdraw->getScheduledWithdrawal(); 
        $coopbank = $this->coopbank->getCoopBanks();
        $data = [
            'coopbank'=>$coopbank,
            'withdraws'=>$withdraws,
            'cart'=>$cart,
	        'withdraw_cart'=>$withdraw_cart,
            'approved_loans'=>$approved_loans,
	        //'approved_withdraw'=>$approved_withdraw
        ];
        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/new-payment-schedule', $data); 
    }


     public function addPaymentToCart(){
        //return dd($_POST);
         helper(['form']);
        $data = [];
        if($_POST){     
            if(!is_null($this->request->getVar('approved_loans')) || !empty($this->request->getVar('withdraws'))){
                if(!is_null($this->request->getVar('approved_loans'))){
                    foreach($this->request->getVar('approved_loans') as $loan){
                        
                        if(isset($loan)){
                            $detail = [
                                'bank_id'=>$this->request->getVar('bank'),
                                'payable_date'=>$this->request->getVar('payable_date'),
                                'transaction_type'=>1,
                                'creation_date'=>date('Y-m-d H:i:s'),
                                //'created_by'=>1,
                                'loan_id'=>$loan,
                            ];
                            //$id = $this->schedulemaster->insert($detail);
                            $loan = $this->loan->where('loan_id', $loan)->first();
                            $this->loan->update($loan, ['cart'=>1]);
                        }
                    }
                }
                
                if(!empty($this->request->getVar('withdraws'))){
                    for($i = 0; $i<count($this->request->getVar('withdraws')); $i++){
                        if(isset($this->request->getVar('withdraw_id')[$i])){                           
                            //$this->withdraw->update($this->request->getVar('withdraw_id')[$i], ['cart'=>1]);
                            $down = $this->withdraw->where('withdraw_id', $this->request->getVar('withdraw_id')[$i])->first();
                            //return dd($down);
                            $this->withdraw->update($down, ['cart'=>1]);
                        }

                    }
                }
                 $alert = array(
                        'msg' => 'Success! Selection was added to cart.',
                        'type' => 'success',
                        'location' => site_url('/loan/new-payment-schedule')
    
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                $alert = array(
                        'msg' => 'Ooops! No selection was made.',
                        'type' => 'error',
                        'location' => site_url('/loan/new-payment-schedule')
    
                    );
                    return view('pages/sweet-alert', $alert);
        
            }

            }    
    }

    public function removeFromCart($id){
        
        $loan = $this->loan->where('loan_id', $id)->first();
        if(!empty($loan)){
            $this->loan->update($loan, ['cart'=>0]);
            $alert = array(
                'msg' => 'Success! Selection removed from cart',
                'type' => 'success',
                'location' => site_url('/loan/new-payment-schedule')

                );
                return view('pages/sweet-alert', $alert);
        }else{
            $alert = array(
                'msg' => 'Ooops! Something went wrong. Could not remove selection.',
                'type' => 'error',
                'location' => site_url('/loan/new-payment-schedule')

            );
            return view('pages/sweet-alert', $alert);
        }
        
    }
    public function removeWithdrawFromCart($id){
        
        $withdraw = $this->withdraw->where('withdraw_id', $id)->first();
        if(!empty($withdraw)){
            $this->withdraw->update($withdraw, ['cart'=>0]);
            $alert = array(
                'msg' => 'Success! Selection removed from cart',
                'type' => 'success',
                'location' => site_url('/loan/new-payment-schedule')

                );
                return view('pages/sweet-alert', $alert);
        }else{
            $alert = array(
                'msg' => 'Ooops! Something went wrong. Could not remove selection.',
                'type' => 'error',
                'location' => site_url('/loan/new-payment-schedule')

            );
            return view('pages/sweet-alert', $alert);
        }
        
    }


     public function postNewPaymentSchedule(){
        helper(['form']);
        $data = [];      
        $masterId = null;
        //return dd($_POST);
        if($_POST){
            $rules = [
                'payable_date'=>[
                    'rules'=>'required',
                    'label'=>'Payable date',
                    'errors'=>[
                        'required'=>'Payable date is required'
                    ]
				],
                'bank'=>[
                    'rules'=>'required',
                    'label'=>'Bank',
                    'errors'=>[
                        'required'=>'Bank is required'
                    ]
				],
            ];
            if($this->validate($rules)){
                $filename = null;
					
                     $file = $this->request->getFile('attachment');
                     if(!empty($file)){
                         if($file->isValid() && !$file->hasMoved()){
                            $extension = $file->guessExtension();
                            $extension = strtolower($extension);
                            if($extension == 'pdf'){
		                            $filename = $file->getRandomName();
                                    $file->move('.uploads/withdrawals', $filename);
                            }
                         }
                     }

                $amount = 0;
                if(!is_null($this->request->getVar('coop_id')) ){
                        for($i = 0; $i<count($this->request->getVar('coop_id')); $i++ ){
                            $amount += $this->request->getVar('amount')[$i];
                        }
                    }
                
					$data = [
                        'payable_date'=>$this->request->getVar('payable_date'),
                        'bank_id'=>$this->request->getVar('bank'),
                        'creation_date'=>date('Y-m-d H:i:s'),
                        'amount'=>$amount,
                        'attachment'=>$filename
					];
                    
                    $masterId = $this->schedulemaster->insert($data);
                    #Schedule detail
                    if(!is_null($this->request->getVar('loan_id'))){
                        for($i = 0; $i<count($this->request->getVar('loan_id')); $i++ ){
                            $detail = [
                                'loan_type'=>$this->request->getVar('loan_type')[$i], 
                                'coop_id'=>$this->request->getVar('coop_id')[$i],
                                'amount'=>$this->request->getVar('amount')[$i],
                                'loan_id'=>$this->request->getVar('loan_id')[$i],
                                'schedule_master_id'=>$masterId,
                                'transaction_type'=>1
                            ];
                            $this->schedulemasterdetail->save($detail);
                            $this->loan->update($this->request->getVar('loan_id')[$i], ['scheduled'=>1]);
                        }
                    }
                    #withdraw detail
                     if(!is_null($this->request->getVar('withdraw_id'))){
                        for($w = 0; $w<count($this->request->getVar('withdraw_id')); $w++ ){
                            $detail = [
                                //'loan_type'=>$this->request->getVar('loan_type')[$i], 
                                'coop_id'=>$this->request->getVar('coop_id')[$w],
                                'amount'=>$this->request->getVar('w_amount')[$w],
                                'schedule_master_id'=>$masterId,
                                'transaction_type'=>2,//withdraw,
                                'loan_id'=>$this->request->getVar('withdraw_id')[$w]
                            ];
                            $this->schedulemasterdetail->save($detail);
                            $withdraw_id = $this->request->getVar('withdraw_id')[$w];
                            //$val = $this->withdraw->where('withdraw_id', )->first();
                            $data = array(
                                'withdraw_id' => $withdraw_id,
                                'scheduled' => 1
                            );

                            $this->withdraw->save($data);
                        }
                    }
            
                    $alert = array(
                        'msg' => 'Success! New payment scheduled',
                        'type' => 'success',
                        'location' => site_url('/loan/new-payment-schedule')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
               $alert = array(
                        'msg' => 'Ooops! Kindly complete the form and submit.',
                        'type' => 'error',
                        'location' => site_url('/loan/new-payment-schedule')
                    );
                    return view('pages/sweet-alert', $alert);
            }
        }
        
    }


     public function showScheduledPayments(){
         $data = [
            'schedules'=>$this->schedulemaster->getScheduleMaster()
        ];
        
        $username = $this->session->user_username;
        
        $this->authenticate_user($username, 'pages/payment/payment-schedules', $data); 
    }
     public function showVerifiedScheduledPayments(){
         $data = [
            'schedules'=>$this->schedulemaster->getVerifiedScheduleMaster()
        ];
        
        $username = $this->session->user_username;
        
        $this->authenticate_user($username, 'pages/payment/approve-payment-schedules', $data); 
    }


    public function showPaymentScheduleDetail($id){
        $master = $this->schedulemaster->getScheduleMasterItem($id);
        $detail = $this->schedulemasterdetail->getScheduleMasterDetail($id);
        if(!empty($master)){
            $data = [
                'detail'=>$detail,
                'master'=>$master
            ];
            
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/payment/view-payment-schedule', $data);

        }else{
           return redirect()->to('/loan/payment-schedules');  
        }
    }


    public function returnSchedulePayment($id){
        $loan = $this->loan->where('loan_id', $id)->first();
            if(!empty($loan)){
                $this->loan->update($loan, ['scheduled'=>0]);
                $this->schedulemasterdetail->where('loan_id', $id)->delete();
                /* $scheduledetail = $this->schedulemasterdetail->where('loan_id', $id)->first();
                $masterId = $schedule->schedule_master_id; */

                $alert = array(
                    'msg' => 'Success! Entry removed from schedule.',
                    'type' => 'success',
                    'location' => site_url('/loan/new-payment-schedule')

                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                $alert = array(
                    'msg' => 'Ooops! Something went wrong. Could not remove selection.',
                    'type' => 'error',
                    'location' => site_url('/loan/new-payment-schedule')

                );
                return view('pages/sweet-alert', $alert);
            }
    }
   
    public function returnBulkSchedule(){
        //return dd($_POST);
        if(!is_null($this->request->getVar('schedule_detail'))){
            foreach($this->request->getVar('schedule_detail') as $schedule){
               // $this->loan->update($loan, ['scheduled'=>0]);
                $this->schedulemasterdetail->where('schedule_master_detail_id', $schedule)->delete();
            }
        }
        
            $alert = array(
                'msg' => 'Ooops! Something went wrong. Could not remove selection.',
                'type' => 'error',
                'location' => site_url('/loan/new-payment-schedule')

            );
            return view('pages/sweet-alert', $alert);
            
    }


    public function verifySchedule(){
        helper(['form']);
        $data = [];
        $username = $this->session->user_username;
        if($_POST){ 
            $this->schedulemaster->update($this->request->getVar('schedule'), 
                ['verified_by'=>$username,
                'date_verified'=>date('Y-m-d H:i:s'),
                'verified'=>1
                ]);
            $alert = array(
                'msg' => 'Success! Payment schedule verified.',
                'type' => 'success',
                'location' => site_url('/loan/payment-schedules')

            );
            return view('pages/sweet-alert', $alert);
        }
    }
    public function approveSchedule(){
        helper(['form']);
        $data = [];
        $username = $this->session->user_username;
        $name = $username;
        if($_POST){ 
            $this->schedulemaster->update($this->request->getVar('schedule'), 
                ['verified_by'=>$name,
                'date_verified'=>date('Y-m-d H:i:s'),
                'approved'=>1,//approved
                'approved_by'=>$name,
                'approved_date'=>date('Y-m-d')
                ]);
            $scheduledetail = $this->schedulemasterdetail->where('schedule_master_id', 
                $this->request->getVar('schedule'))->findAll();
	       
	        $sm = $this->schedulemaster->where('schedule_master_id', $this->request->getVar('schedule'))->first();
	       
	        
	        ## getting bank gl code
	        $cb_id = $sm['bank_id'];
	        $cb = $this->coopbank->where('coop_bank_id', $cb_id)->first();
	        $b_gl = $cb['glcode'];
	        
//	        echo $b_gl;
	        
            foreach($scheduledetail as $detail){

	            $ref_code = time();

                if($detail['transaction_type'] == 1){ //loan

                	//$loan = $this->loan->where('loan_id', $detail['loan_id'])->first();

                	$loan = $this->loan->get_loan($detail['loan_id']);

	                //print_r($detail);
//
	                $p_d = date('Y-m-d H:i:s');
                	$loan_array = array(
                		'loan_id' => $detail['loan_id'],
		                'disburse'=>1,
		                'disburse_date'=>$p_d
	                );

                     $this->loan->save($loan_array);

	                $interest_method = $loan['interest_method'];
	                $interest_charge_type = $loan['interest_charge_type'];
	                $ls_interest_rate = $loan['ls_interest_rate'];
	                $interest_amount = 0;
	                $loan_amount = $loan['amount'];
	                $duration = $loan['duration'];

	                if($interest_method == 1){
		                #register loan repayment

		                if($interest_charge_type == 1){ #flat interest type

			                $interest_amount = ($ls_interest_rate/100) * $loan_amount;

		                }


		                if($interest_charge_type == 2){ #fmonthly type

			                $interest_amount =  $loan_amount * ($ls_interest_rate/100) * $duration;

		                }

		                if($interest_charge_type == 3){ #fmonthly type

			                $interest_amount =  $loan_amount * ($ls_interest_rate/100) * ($duration/12);

		                }
		                
		                $cooperator = $this->coop->where('cooperator_staff_id', $loan['staff_id'])->first();
		                
		                $staff_name = $cooperator['cooperator_first_name'].' '.$cooperator['cooperator_last_name'];



		                $loan_repayment = [
			                'lr_staff_id' => $loan['staff_id'],
			                'lr_loan_id' => $loan['loan_id'],
			                'lr_month' => date('m', strtotime($loan['created_at'])),
			                'lr_year' => date('Y', strtotime($loan['created_at'])),
			                'lr_amount' => $interest_amount,
			                'lr_dctype' => 2,
			                'lr_ref' => $ref_code,
			                'lr_narration' => 'Interest on loan',
			                'lr_mi' => 0,
			                'lr_mpr' => 0,
			                'lr_interest' => 1,
			                'lr_date' => date('Y-m-d H:i:s'),
		                ];
		                $this->loanrepayment->save($loan_repayment);




		                //disbursed loan entering GL
	                }

                     //credit bank --

	                $account = $this->coa->where('glcode', $b_gl)->first();
	                $bankGl = array(
		                'glcode' => $b_gl,
		                'posted_by' => $this->session->user_username,
		                'narration' => $loan['loan_description'].' disbursement',
		                'dr_amount' => 0,
		                'cr_amount' => $loan['amount'],
		                'ref_no' =>$ref_code,
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'gl_transaction_date' =>$p_d,
		                'created_at' => date('Y-m-d'),
		                'gl_description' => 'Staff id:'.$loan['staff_id'].', Staff Name:'.$staff_name.' Loan id:'.$loan['loan_id'],
	                );
	                $this->gl->save($bankGl);

	                //  debit loan

	                $account = $this->coa->where('glcode', $loan->loan_gl_account_no)->first();
	                $bankGl = array(
		                'glcode' => $loan['loan_gl_account_no'],
		                'posted_by' => $this->session->user_username,
		                'narration' => $loan['loan_description'].' disbursement ',
		                'dr_amount' => $loan['amount'] + $interest_amount,
		                'cr_amount' => 0,
		                'ref_no' =>$ref_code,
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'gl_transaction_date' =>$p_d,
		                'created_at' => date('Y-m-d'),
		                'gl_description' => 'Staff id:'.$loan['staff_id'].', Staff Name:'.$staff_name.' Loan id:'.$loan['loan_id'],
	
	                );
	                $this->gl->save($bankGl);

	                // check for upfront interest

	                if($interest_amount > 0):
		                $account = $this->coa->where('glcode', $loan->loan_unearned_int_gl_account)->first();
		                $bankGl = array(
			                'glcode' => $loan['loan_unearned_int_gl_account'],
			                'posted_by' => $this->session->user_username,
			                'narration' => $loan['loan_description'].' disbursement',
			                'dr_amount' => 0,
			                'cr_amount' => $interest_amount,
			                'ref_no' =>$ref_code,
			                'bank' => $account['bank'],
			                'ob' => 0,
			                'posted' => 1,
			                'gl_transaction_date' =>$p_d,
			                'created_at' => date('Y-m-d'),
			                'gl_description' => 'Staff id:'.$loan['staff_id'].', Staff Name:'.$staff_name.' Loan id:'.$loan['loan_id'],
		
		                );
		                $this->gl->save($bankGl);

		                endif;





                }elseif($detail['transaction_type'] == 2){ //withdraw
//
                	$masters = $this->schedulemaster->where('schedule_master_id',$this->request->getVar('schedule') )->first();
                	$payable_date = $masters['payable_date'];
                    $withdraw_id = $detail['loan_id'];
                     $data = array(
                                'withdraw_id' => $withdraw_id,
                                'disburse'=>1,
                                'disburse_date'=>date('Y-m-d H:i:s')
                            );

                            //$this->withdraw->save($data);

                   $withdraw = $this->withdraw->where('withdraw_id', $withdraw_id)->first();
                    //$this->withdraw->update($withdraw, []);
                    #register withdraw
                    $cooperator = $this->coop->where('cooperator_staff_id', $withdraw['withdraw_staff_id'])->first();
	                $staff_name = $cooperator['cooperator_first_name'].' '.$cooperator['cooperator_last_name'];

                    $ref_code = time();
                    $payment_type = 1;
                    if($withdraw['withdraw_narration'] == 'Account Closure'):
	                    $payment_type = 7;
	                    endif;

                     $payment_details_array = array(
                        'pd_staff_id' => $withdraw['withdraw_staff_id'],
                        'pd_transaction_date' =>$payable_date,
                        'pd_narration' => $withdraw['withdraw_narration'],
                        'pd_amount' => $withdraw['withdraw_amount'],
                        'pd_payment_type' => $payment_type,
                        'pd_drcrtype' => 2,
                        'pd_ct_id' => $withdraw['withdraw_ct_id'],
                        'pd_pg_id' => $cooperator['cooperator_payroll_group_id'],//$cooperator_payroll_group_id,
                        'pd_ref_code' => $ref_code,
                    );

                    $v =  $this->paymentdetail->save($payment_details_array);

                    $wt = $this->ct->where('contribution_type_id', $withdraw['withdraw_ct_id'])->first();

                    //dr contribution type gl amount
	                $account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();

	                $bankGl = array(
		                'glcode' => $wt['contribution_type_glcode'],
		                'posted_by' => $this->session->user_username,
		                'narration' => $withdraw['withdraw_narration'],
		                'dr_amount' => $withdraw['withdraw_amount'],
		                'cr_amount' => 0,
		                'ref_no' =>$ref_code,
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'gl_transaction_date' =>$payable_date,
		                'created_at' => date('Y-m-d'),
		                'gl_description' => 'Staff id:'.$withdraw['withdraw_staff_id'].', Staff Name:'.$staff_name.' Contribution Type:'.$wt['contribution_type_name'],
	
	                );
	                $this->gl->save($bankGl);


	#########################################################-----------##########################
	                $payment_details_array = array(
		                'pd_staff_id' => $withdraw['withdraw_staff_id'],
		                'pd_transaction_date' =>$payable_date,
		                'pd_narration' => 'Charges on withdrawal',
		                'pd_amount' => $withdraw['withdraw_charges'],
		                'pd_payment_type' => 2,
		                'pd_drcrtype' => 2,
		                'pd_ct_id' => $withdraw['withdraw_ct_id'],
		                'pd_pg_id' => $cooperator['cooperator_payroll_group_id'],//$cooperator_payroll_group_id,
		                'pd_ref_code' => $ref_code,
	                );

	                $v =  $this->paymentdetail->save($payment_details_array);


	                $wt = $this->ct->where('contribution_type_id', $withdraw['withdraw_ct_id'])->first();

	                //dr contribution type gl charges
	                $account = $this->coa->where('glcode', $wt['contribution_type_glcode'])->first();
	                $bankGl = array(
		                'glcode' => $wt['contribution_type_glcode'],
		                'posted_by' => $this->session->user_username,
		                'narration' => 'Charges on withdrawal',
		                'dr_amount' => $withdraw['withdraw_charges'],
		                'cr_amount' => 0,
		                'ref_no' =>$ref_code,
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'gl_transaction_date' =>$payable_date,
		                'created_at' => date('Y-m-d'),
		                'gl_description' => 'Staff id:'.$withdraw['withdraw_staff_id'].', Staff Name:'.$staff_name.' Contribution Type:'.$wt['contribution_type_name'],
	
	                );
	                $this->gl->save($bankGl);


	                //credit bank
	                $account = $this->coa->where('glcode', $b_gl)->first();
	                $bankGl = array(
		                'glcode' => $b_gl,
		                'posted_by' => $this->session->user_username,
		                'narration' => $withdraw['withdraw_narration'],
		                'dr_amount' => 0,
		                'cr_amount' => $withdraw['withdraw_amount'],
		                'ref_no' =>$ref_code,
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'gl_transaction_date' =>$payable_date,
		                'created_at' => date('Y-m-d'),
		                'gl_description' => 'Staff id:'.$withdraw['withdraw_staff_id'].', Staff Name:'.$staff_name.' Contribution Type:'.$wt['contribution_type_name'],
	
	                );
	                $this->gl->save($bankGl);

	                $bankGl = array(
		                'glcode' => $b_gl,
		                'posted_by' => $this->session->user_username,
		                'narration' => 'Charges on withdrawal',
		                'dr_amount' => 0,
		                'cr_amount' => $withdraw['withdraw_charges'],
		                'ref_no' =>$ref_code,
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'gl_transaction_date' =>$payable_date,
		                'created_at' => date('Y-m-d'),
		                'gl_description' => 'Staff id:'.$withdraw['withdraw_staff_id'].', Staff Name:'.$staff_name.' Contribution Type:'.$wt['contribution_type_name'],
	
	                );
	                $this->gl->save($bankGl);
                }

            }
            $alert = array(
                'msg' => 'Success! Payment disbursed.',
                'type' => 'success',
                'location' => site_url('/loan/payment-schedules')

            );
            return view('pages/sweet-alert', $alert);
        }
    }



    public function entry(){
        $banks = $this->banks->getBanks();
        $coas =  $this->coa->where('type',1)->findAll();
        $data = [
            'banks'=>$banks,
            'coas'=>$coas
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/entry', $data); 
    }

    public function postThirdpartyPaymentEntry(){
         helper(['form']);
        $data = [];

        if($_POST){
            $filename = null;
					
            $file = $this->request->getFile('attachment');
            if(!empty($file)){
                if($file->isValid() && !$file->hasMoved()){
                $extension = $file->guessExtension();
                $extension = strtolower($extension);
                    if($extension == 'pdf'){
                            $filename = $file->getRandomName();
                            $file->move('.uploads/withdrawals', $filename);
                    }
                }
            }
            $data = [
            'entry_payment_date' => $this->request->getVar('payable_date'),
            'entry_bank_id'=>$this->request->getVar('payee_bank'), 
            'entry_amount'=>$this->request->getVar('amount'), 
            'entry_gl_account_no'=>$this->request->getVar('gl_account'),
            'entry_reference_no'=>$this->request->getVar('reference_no'), 
            'entry_narration'=>$this->request->getVar('narration'), 
            'entry_payee_name'=>$this->request->getVar('payee_name'), 
            'entry_payee_bank'=>$this->request->getVar('payee_bank'),
            'entry_bank_account_no'=>$this->request->getVar('bank_account_no'),
            'entry_sort_code'=>$this->request->getVar('sort_code'),
            'entry_attachment'=>$filename
            ];
            $this->thirpartypaymententry->save($data);
            
            $alert = array(
                'msg' => 'Success! New payment entry done.',
                'type' => 'success',
                'location' => site_url('/third-party/payment/entry')

            );
            return view('pages/sweet-alert', $alert);
        }
    }

    public function newPayment(){
        $coopbank = $this->coopbank->getCoopBanks();
        $coas =  $this->coa->where('type',1)->findAll();
        $entries = $this->thirpartypaymententry->getEntries();
        $data = [
            'coopbank'=>$coopbank,
            'coas'=>$coas,
            'entries'=>$entries
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/new-payment', $data); 
    }

    public function postNewPayment(){
       
        if($_POST){
            $amount = 0;
            for($n = 0; $n < count($this->request->getVar('entries')); $n++){
                     $amount += $this->request->getVar('entry_amount')[$n];
                 } 
            /* $thirdpartyId = $this->thirpartypaymententry->getLastRecord();
            return dd($thirdpartyId); */
            $masterId = null;
                $masterdata = [
                    'entry_payment_bank_id'=>$this->request->getVar('coop_bank'), 
                    'entry_payment_payable_date'=>$this->request->getVar('payable_date'), 
                    'entry_payment_cheque_no'=>$this->request->getVar('cheque_no'),
                    'entry_payment_amount'=>$amount
                ];
                $masterId = $this->entrypaymentmaster->insert($masterdata);
                
               if(!empty($this->request->getVar('entries'))){
                 for($i=0; $i<count($this->request->getVar('entries')); $i++){
                     $detail = [
                        'entry_payment_d_master_id'=> $masterId, 
                        'entry_payment_d_payee_bank'=>$this->request->getVar('payee_bank')[$i], 
                        'entry_payment_d_payee_name'=>$this->request->getVar('payee_name')[$i],
                        'entry_payment_d_amount'=>$this->request->getVar('entry_amount')[$i], 
                        'entry_payment_d_bank_name' =>$this->request->getVar('bank_name')[$i], 
                        'entry_payment_d_account_no'=>$this->request->getVar('account_no')[$i], 
                        'entry_payment_d_reference_no'=>$this->request->getVar('reference_no')[$i],
                        'entry_payment_d_gl_account_no'=>$this->request->getVar('gl_account_no')[$i],
                        'third_party_payment_entry_id'=>$this->request->getVar('entry_id')[$i],
                     ];
                     $this->entrypaymentdetail->save($detail);
                     $this->thirpartypaymententry->save(['third_party_payment_entry_id'=>$this->request->getVar('entry_id')[$i],
                     'cart'=>1]);
                 } 
                }  
            $alert = array(
                'msg' => 'Success! Payment added to cart.',
                'type' => 'success',
                'location' => site_url('/third-party/new-payment')

            );
            return view('pages/sweet-alert', $alert);
        }
    }

    public function verifyPaymentEntry(){
        $data = [
            'entry_master'=>$this->entrypaymentmaster->getEntryMaster(),
        ];
        $username = $this->session->user_username;
        
        $this->authenticate_user($username, 'pages/payment/verify-payment-entry', $data); 
    }


    public function viewVerifyPaymentEntry($id){
        $data = [
            'entry_master'=>$this->entrypaymentmaster->getEntryMasterById($id),
            'entry_detail'=>$this->entrypaymentdetail->getEntryDetailById($id)
        ];
        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/view-verify-payment-entry', $data); 
    }


    public function postVerifyPaymentEntry(){
        if($_POST){
           
            //if($this->validate($rules)){
                $username = $this->session->user_username;
                //for($i=0; $i<count($this->request->getVar('thirdpartyentry')); $i++){

					$data = [
                        'entry_payment_master_id'=>$this->request->getVar('entry_master'),
                        'entry_payment_verified'=>1,
                        'entry_payment_date_verified'=>$this->request->getVar('date_verified'),
                        'entry_payment_verified_by'=> $this->user->where('email', $username)->first()['user_id'],
                        ];
                        
                    $this->entrypaymentmaster->save($data);
                //}
                $alert = array(
                    'msg' => 'Success! Payment entry verified.',
                    'type' => 'success',
                    'location' => site_url('/third-party/verify-payment-entry')
                );
                return view('pages/sweet-alert', $alert);
				
            /* }else{
                return $this->response->redirect(site_url('/loan/verify'));
            } */
        }
    }
    public function returnAllUnverifiedPaymentEntry($masterId){
                $master = $this->entrypaymentmaster->getEntryMasterById($masterId);
                if(!empty($master)){
                    $this->entrypaymentmaster->delete($masterId);
                    $details = $this->entrypaymentdetail->getPaymentDetailsByMasterId($masterId);
                   
                    if(!empty($details)){
                        foreach($details as $detail){
                            $this->entrypaymentdetail->delete($detail->entry_payment_d_detail_id);
                        }
                    }
                    $alert = array(
                        'msg' => 'Success! Payment entry declined.',
                        'type' => 'success',
                        'location' => site_url('/third-party/verify-payment-entry')
                    );
                    return view('pages/sweet-alert', $alert);

                }else{
                    $alert = array(
                        'msg' => 'Ooops! No record found.',
                        'type' => 'error',
                        'location' => site_url('/third-party/verify-payment-entry')
                    );
                    return view('pages/sweet-alert', $alert);
                }
                    
        
    }
    public function returnOneUnverifiedPaymentEntry($detailId){
        
        $details = $this->entrypaymentdetail->getPaymentDetailsByDetailId($detailId);               
                    if(!empty($details)){
                        #Last record
                        /* if(count($details) == 1){
                            return dd($details[0]);
                            $master = $this->entrypaymentmaster->getEntryMasterById($masterId);
                        } */
                            foreach($details as $detail){
                                $this->entrypaymentdetail->delete($detail->entry_payment_d_detail_id);
                            }
                            $alert = array(
                                'msg' => 'Success! Payment entry declined.',
                                'type' => 'success',
                                'location' => site_url('/third-party/verify-payment-entry')
                            );
                            return view('pages/sweet-alert', $alert);
                        }else{

                            $alert = array(
                                'msg' => 'Ooops! No record found.',
                                'type' => 'error',
                                'location' => site_url('/third-party/verify-payment-entry')
                            );
                            return view('pages/sweet-alert', $alert);
                        }
                    
        
    }

    public function approvePaymentEntry(){
        $data = [
            'entry_master'=>$this->entrypaymentmaster->getVerifiedEntryMaster(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/approve-payment-entry', $data); 
    }
    
    public function postApprovedPaymentEntry(){
        if($_POST){
           //return dd($_POST);
            //if($this->validate($rules)){
                $username = $this->session->user_username;
                //for($i=0; $i<count($this->request->getVar('thirdpartyentry')); $i++){
                    $entry_payment = $this->entrypaymentmaster->where('entry_payment_master_id',$this->request->getVar('entry_master'))->first();
                    if(!empty($entry_payment)){
                        $data = [
                            'entry_payment_master_id'=>$this->request->getVar('entry_master'),
                            'entry_payment_approved'=>1,
                            'entry_payment_approved_date'=>date('Y-m-d H:i:s'),
                            'entry_payment_approved_by'=> $this->user->where('email', $username)->first()['user_id'],
                            ];
                        $this->entrypaymentmaster->save($data);
                        #Get payment details
                        $details = $this->entrypaymentdetail->getPaymentDetailsByMasterId($this->request->getVar('entry_master'));
                       if(!empty($details)){
                           foreach($details as $detail){
                               
                                #gl details
                                 $dr = [
                                    'glcode'=>$detail->entry_payment_d_gl_account_no,
                                    'posted_by'=> $this->user->where('email', $username)->first()['user_id'],
                                    'dr_amount'=>0,
                                    'bank'=>0,
                                    'ob'=>0,
                                    'cr_amount'=>$detail->entry_payment_d_amount,
                                    'ref_no'=>time(),
                                    'created_at'=>date('Y-m-d H:i:s')
                                ];
                                $this->gl->save($dr); 
                           }
                       }
                       $getbank = $this->coopbank->getBank($entry_payment['entry_payment_bank_id']);
                        $cr = [
                            'glcode'=> $getbank->glcode,
                            'posted_by'=> $this->user->where('email', $username)->first()['user_id'],
                            'cr_amount'=>0,
                            'bank'=>0,
                            'ob'=>0,
                            'dr_amount'=>$entry_payment['entry_payment_amount'],
                            'ref_no'=>time(),
                            'created_at'=>date('Y-m-d H:i:s')
                        ];
                        $this->gl->save($cr); 
                    //}
                    $alert = array(
                        'msg' => 'Success! Payment entry approved.',
                        'type' => 'success',
                        'location' => site_url('/third-party/approve-payment-entry')
                    );
                    return view('pages/sweet-alert', $alert);

                    }else{
                          $alert = array(
                            "msg" => "Ooops! There's no such record.",
                            "type" => "error",
                            "location" => site_url("/third-party/approve-payment-entry")
                        );
                        return view("pages/sweet-alert", $alert);
                    }
				
            /* }else{
                return $this->response->redirect(site_url('/loan/verify'));
            } */
        }
    }


    public function returnPayment($id){
        $data = [
            'third_party_payment_entry_id'=>$id,
            'entry_verified'=>0
            ];
            $this->thirpartypaymententry->save($data);

        $alert = array(
                'msg' => 'Success! Payment entry returned.',
                'type' => 'success',
                'location' => site_url('/third-party/new-payment')
            );
            return view('pages/sweet-alert', $alert);
    }

    public function paymentList(){
        $data = [
            'entries'=>$this->entrypaymentmaster->getPaymentEntries()
        ];
        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/payment-list', $data); 
    }


    public function getThirdpartyEntry($id){
        $data = [
            'entry'=>$this->thirpartypaymententry->getThirdpartyEntry($id)
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/view-payment-entry-details', $data); 
    }
}
