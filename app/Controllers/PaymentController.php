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

class PaymentController extends BaseController
{

    public function __construct(){
        $this->session = session();
		$this->loanapp = new LoanApplicationModel();
		$this->coop = new Cooperators();
        $this->loansetup = new LoanSetupModel();
        $this->coopbank = new CoopBankModel();
        $this->schedulemaster = new ScheduleMasterModel();
        $this->schedulemasterdetail = new ScheduleMasterDetailModel();
        $this->loan = new LoanModel();
        $this->withdraw = new WithdrawModel();
        $this->user = new UserModel();
        $this->paymentdetail = new PaymentDetailsModel();
        $this->paymentcart = new PaymentCartModel();
        $this->session = session();
    }



    public function newPaymentSchedule(){
         $data = [];
         #approved loans
         $approved_loans = $this->loan->getApprovedLoans();
         #cart
         $cart = $this->loan->getItemsInCart();
        #withdraw request
        $withdraws = $this->withdraw->getScheduledWithdrawal(); 
        $coopbank = $this->coopbank->getCoopBanks();
        $data = [
            'coopbank'=>$coopbank,
            'withdraws'=>$withdraws,
            'cart'=>$cart,
            'approved_loans'=>$approved_loans
        ];
        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/payment/new-payment-schedule', $data); 
    }


     public function addPaymentToCart(){
         helper(['form']);
        $data = [];
        if($_POST){            
                #register loan application
                if(!empty($this->request->getVar('approved_loans')) ){
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


     public function postNewPaymentSchedule(){
        helper(['form']);
        $data = [];      
        $masterId = null;
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
                $amount = 0;
                if(count($this->request->getVar('coop_id')) > 0){
                        for($i = 0; $i<count($this->request->getVar('coop_id')); $i++ ){
                            $amount += $this->request->getVar('amount')[$i];
                        }
                    }
                    //return dd($amount);
					$data = [
                        'payable_date'=>$this->request->getVar('payable_date'),
                        'bank_id'=>$this->request->getVar('bank'),
                        'creation_date'=>date('Y-m-d H:i:s'),
                        'amount'=>$amount
					];
                    
                    $masterId = $this->schedulemaster->insert($data);
                    #Schedule detail
                    if(count($this->request->getVar('coop_id')) > 0){
                        for($i = 0; $i<count($this->request->getVar('coop_id')); $i++ ){
                            $detail = [
                                'loan_type'=>$this->request->getVar('loan_type')[$i], 
                                'coop_id'=>$this->request->getVar('coop_id')[$i],
                                'amount'=>$this->request->getVar('amount')[$i],
                                'loan_id'=>$this->request->getVar('loan_id')[$i],
                                'schedule_master_id'=>$masterId
                            ];
                            $this->schedulemasterdetail->save($detail);
                            $this->loan->update($this->request->getVar('loan_id'), ['scheduled'=>1]);
                        }
                    }
                    #withdraw detail
                    /* if($this->request->getVar('withdraws')){
                        for($i = 0; $i<count($this->request->getVar('withdraw_staff_id')); $i++ ){
                            $detail = [
                                //'loan_type'=>$this->request->getVar('loan_type')[$i], 
                                'coop_id'=>$this->request->getVar('withdraw_staff_id')[$i],
                                'amount'=>$this->request->getVar('withdraw_amount')[$i],
                                'schedule_master_id'=>$id
                            ];
                            $this->schedulemasterdetail->save($detail);
                            //$loan = $this->loan->where('loan_id', $this->request->getVar('loan_id'))->first()['loan_id'];
                            $this->withdraw->update($this->request->getVar('withdraw_id'), ['withdraw_status'=>4]);
                        }
                    } */
            
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
                ['verified_by'=>$this->user->where('email', $username)->first()['first_name'],
                'date_verified'=>date('Y-m-d H:i:s'),
                'verified'=>1
                ]);
            $alert = array(
                'msg' => 'Success! Payment shedule verified.',
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
        if($_POST){ 
            $this->schedulemaster->update($this->request->getVar('schedule'), 
                ['verified_by'=>$this->user->where('email', $username)->first()['first_name'],
                'date_verified'=>date('Y-m-d H:i:s'),
                'verified'=>2//approved
                ]);
            $scheduledetail = $this->schedulemasterdetail->where('schedule_master_id', 
                $this->request->getVar('schedule'))->findAll();
           // return dd($scheduledetail);
            foreach($scheduledetail as $detail){
                $loan = $this->loan->where('loan_id', $detail['loan_id'])->first();
                $this->loan->update($loan, ['disburse'=>1, 'disburse_date'=>date('Y-m-d H:i:s')]);
            }
            $alert = array(
                'msg' => 'Success! Payment disbursed.',
                'type' => 'success',
                'location' => site_url('/loan/payment-schedules')

            );
            return view('pages/sweet-alert', $alert);
        }
    }

}