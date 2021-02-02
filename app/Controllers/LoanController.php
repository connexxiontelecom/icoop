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

class LoanController extends BaseController
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
        $this->session = session();
    }

	public function showLoanApplicationForm()
	{
        $data = [];
        $data = [
            'loan_types'=>$this->loansetup->where('status',1)->findAll()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/new', $data);
    }
    
    public function getCooperator($id){
        $cooperator = $this->coop->where('cooperator_staff_id', $id)->first();
        $savings = $this->loan->getCooperatorSavings($id);
        $data = [
            'cooperator'=>$cooperator,
            'savings'=>$savings
        ];
        return json_encode($data);
    }
    public function getGuarantor($id){
        $cooperator = $this->coop->where('cooperator_staff_id', $id)->first();
        $data = [
            'cooperator'=>$cooperator
        ];
        return json_encode($data);
    }
    public function getLoanType($id){
        $setup = $this->loansetup->where('loan_setup_id', $id)->first();
        return json_encode($setup);
    }

	public function storeLoanApplication()
	{
     
        helper(['form', 'date']);
        $data = [];

        if($_POST){
            $rules = [
                'staff_id'=>[
                    'rules'=>'required',
                    'label'=>'Staff ID',
                    'errors'=>[
                        'required'=>'Staff ID is required'
                    ]
					],
                'loan_type'=>[
                    'rules'=>'required',
                    'label'=>'Loan type',
                    'errors'=>[
                        'required'=>'Loan type is required'
                    ]
					],
                'duration'=>[
                    'rules'=>'required',
                    'label'=>'Duration',
                    'errors'=>[
                        'required'=>'Duration is required'
                    ]
					],
                'amount'=>[
                    'rules'=>'required',
                    'label'=>'Amount',
                    'errors'=>[
                        'required'=>'Amount is required'
                    ]
					],
                'guarantor_1'=>[
                    'rules'=>'required',
                    'label'=>'Guarantor',
                    'errors'=>[
                        'required'=>'Guarantor is required'
                    ]
					],
                'guarantor_2'=>[
                    'rules'=>'required',
                    'label'=>'Guarantor',
                    'errors'=>[
                        'required'=>'Guarantor is required'
                    ]
					],
            ];
            if($this->validate($rules)){
					$data = [
						'staff_id'=>$this->request->getVar('staff_id'),
						'guarantor'=>$this->request->getVar('guarantor_1'),
						'guarantor_2'=>$this->request->getVar('guarantor_2'),
						'loan_type'=>$this->request->getVar('loan_type'),
						'duration'=>$this->request->getVar('duration'),
                        'amount'=>str_replace(",","",$this->request->getVar('amount')),
                        'applied_date'=>date('Y-m-d H:i:s'),
						//'loan_terms'=>$this->request->getVar('loan_terms'),
					];
                    $this->loanapp->save($data);
                    $alert = array(
                        'msg' => 'Success! Loan application done.',
                        'type' => 'success',
                        'location' => site_url('/loan/verify')

                    );
                    return view('pages/sweet-alert', $alert);
				
            }else{
                return $this->response->redirect(site_url('/loan/new'));
            }
        }
	}

    public function showVerifyApplications()
	{
        $data = [];
        $data = [
            'applications'=>$this->loanapp->getLoanVerification(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/verify', $data);
    }

    public function verifyLoanApplication(){
        helper(['form']);
        $data = [];
        $username = $this->session->user_username;
        if($_POST){
            $rules = [
                'application_id'=>[
                    'rules'=>'required',
                    'label'=>'Loan application ID',
                    'errors'=>[
                        'required'=>'Loan application ID is required'
                    ]
				],
            ];
            if($this->validate($rules)){
					$data = [
                        'verify_comment'=>$this->request->getVar('comment'),
                        'verify'=>1,
                        'verify_date'=>date('y-m-d H:i:s'),
                        'verified_by'=> $this->user->where('email', $username)->first()['user_id'],
					];
                    $this->loanapp->update($this->request->getVar('application_id'), $data);
            $alert = array(
                'msg' => 'Success! Loan application verified.',
                'type' => 'success',
                'location' => site_url('/loan/verify')
            );
            return view('pages/sweet-alert', $alert);
				
            }else{
                return $this->response->redirect(site_url('/loan/verify'));
            }
        }
    }
    public function showApproveApplications()
	{
        $data = [];
        $data = [
            'applications'=>$this->loanapp->getLoanApproval(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/approve', $data);
    }

    public function approveLoanApplication(){
        helper(['form']);
        $data = [];
        $username = $this->session->user_username;
        if($_POST){
            $rules = [
                'application_id'=>[
                    'rules'=>'required',
                    'label'=>'Loan application ID',
                    'errors'=>[
                        'required'=>'Loan application ID is required'
                    ]
				],
            ];
            if($this->validate($rules)){
					$data = [
                        'approve_comment'=>$this->request->getVar('comment'),
                        'approve'=>1,
                        'approved_by'=> $this->user->where('email', $username)->first()['user_id'],
                        'approve_date'=>date('Y-m-d H:i:s'),

                    ];
                    $application = $this->loanapp->where('loan_app_id', $this->request->getVar('application_id'))->first();
                    $this->loanapp->update($this->request->getVar('application_id'), $data);
                    #Register loan
                    $loanData = [
                        'staff_id'=>$application['staff_id'],
                        'loan_app_id'=>$application['loan_app_id'],
                        'amount'=>$application['amount'],
                        'interest'=>$this->request->getVar('interest'),
                        'interest_rate'=>$this->request->getVar('interest_rate'),
                        //'amount'=>$this->request->getVar('principal_amount'),
                        'created_at'=>date('Y-m-d H:i:s'),
                        'disburse'=>0,
                        'scheduled'=>0,
                        'loan_type'=>$this->request->getVar('loan_type'),
                    ];
                    $this->loan->save($loanData);
                    $alert = array(
                        'msg' => 'Success! Loan application approved.',
                        'type' => 'success',
                        'location' => site_url('/loan/approve')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                return $this->response->redirect(site_url('/loan/approve'));
            }
        }
    }
	
    public function viewLoanApplication($id){
        $app = $this->loanapp->getLoanApplicationDetail($id);
        $data = [
            'application'=>$app,
            'guarantor'=>$this->loanapp->getGuarantorOne($id),
            'guarantor2'=>$this->loanapp->getGuarantorTwo($id),
            'setup'=>$this->loansetup->where('loan_setup_id', $app->loan_type)->first()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/view-loan-application', $data);
    }

    public function showPaymentSchedule(){
        $data = [];
        $loan_apps = $this->loan->getScheduledPayment(); 
        $withdraws = $this->withdraw->getScheduledWithdrawal(); 
        $coopbank = $this->coopbank->getCoopBanks();
        $data = [
            'loan_apps'=>$loan_apps,
            'coopbank'=>$coopbank,
            'withdraws'=>$withdraws
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/new-payment-schedule', $data); 
    }

    public function newPaymentSchedule(){
        helper(['form']);
        $data = [];
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
					$data = [
                        'payable_date'=>$this->request->getVar('payable_date'),
                        'bank_id'=>$this->request->getVar('bank'),
                        'creation_date'=>date('Y-m-d H:i:s'),
					];
                    
                    $id = $this->schedulemaster->insert($data);
                    #Schedule detail
                    if($this->request->getVar('approved_loans')){
                        for($i = 0; $i<count($this->request->getVar('coop_id')); $i++ ){
                            $detail = [
                                //'loan_type'=>$this->request->getVar('loan_type')[$i], 
                                'coop_id'=>$this->request->getVar('coop_id')[$i],
                                'amount'=>$this->request->getVar('amount')[$i],
                                'schedule_master_id'=>$id
                            ];
                            $this->schedulemasterdetail->save($detail);
                            //$loan = $this->loan->where('loan_id', $this->request->getVar('loan_id'))->first()['loan_id'];
                            $this->loan->update($this->request->getVar('loan_id'), ['scheduled'=>1]);
                        }
                    }
                    #withdraw detail
                    if($this->request->getVar('withdraws')){
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
                    }
            
                    $alert = array(
                        'msg' => 'Success! New payment scheduled',
                        'type' => 'success',
                        'location' => site_url('/loan/new-payment-schedule')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                return $this->response->redirect(site_url('/loan/new-payment-schedule'));
            }
        }
    }


    public function showPaymentSchedules(){
         $data = [
            'schedules'=>$this->schedulemaster->getScheduleMaster()
        ];
        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/payment-schedules', $data); 
    }

    public function showPaymentScheduleDetail($id){
        $content = $this->schedulemaster->getSchedulePaymentDetail($id);
        if(!empty($content)){
            $data = [
                'schedule'=>$content
            ];
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/loan/view-payment-schedule', $data);

        }else{
           return redirect()->to('/loan/payment-schedules');  
        }
    }


    public function showLoandPayables(){
        $data = [
            'payables'=>$this->loan->getPayables(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/payables', $data);
    }

    public function loanPayableAction(){
        helper(['form']);
        $data = [];
        if($_POST){
            $rules = [
                'loan'=>[
                    'rules'=>'required',
                    'label'=>'Loan',
                    'errors'=>[
                        'required'=>'Loan is required'
                    ]
				],
                'hidden_action'=>[
                    'rules'=>'required',
                    'label'=>'Action name',
                    'errors'=>[
                        'required'=>'Action name is required'
                    ]
				],
            ];
            if($this->request->getVar('hidden_action') == 'approve'){
                $this->loan->update($this->request->getVar('loan'), ['disburse'=>1]);
                $alert = array(
                        'msg' => 'Success! Loan disbursed',
                        'type' => 'success',
                        'location' => site_url('/loan/payables')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                $this->loan->update($this->request->getVar('loan'), ['disburse'=>0]);
                $alert = array(
                        'msg' => 'Success! Loan declined.',
                        'type' => 'success',
                        'location' => site_url('/loan/payables')
                    );
                    return view('pages/sweet-alert', $alert);
            }
        }
    }

   /*  public function showPayableDetail($id){
        $content = $this->schedulemaster->getPayableDetails($id);
        if(!empty($content)){
            $data = [
                'detail'=>$content
            ];
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/loan/view-payment-schedule', $data);

        }else{
           return redirect()->to('/loan/payment-schedules');  
        }
    } */
}
