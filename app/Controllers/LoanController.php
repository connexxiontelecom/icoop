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
use \App\Models\ContributionTypeModel;
use \App\Models\AccountClosureModel;

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
        $this->paymentdetail = new PaymentDetailsModel();
        $this->paymentcart = new PaymentCartModel();
        $this->ct = new ContributionTypeModel();
        $this->ac = new AccountClosureModel();
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
    
    
   /*  public function getCooperator($id){
        $cooperator = $this->coop->where('cooperator_staff_id', $id)->first();
        $savings = $this->loan->getCooperatorSavings($id);
        $data = [
            'cooperator'=>$cooperator,
            'savings'=>$savings
        ];
        return json_encode($data);
    } */
    public function getSavings(){ 
        $staff_id = $_POST['staff_id'];
        $savings = $this->loan->getCooperatorSavings($staff_id);
        $data = [
            'savings'=>$savings
        ];
        echo json_encode($data);
        
    }
    public function searchCooperator()
    {
        $value = $_GET['term'];
        if(empty($value)){
            redirect('home/error_404');
        }
        else {
            $cooperators = $this->coop->search_cooperators($value);
            foreach ($cooperators as $cooperator) {
                $data[] = $cooperator->cooperator_staff_id . ', ' . $cooperator->cooperator_first_name . ' ' . $cooperator->cooperator_last_name;

            }
            echo json_encode($data);
            die;
        }
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

    public function getCooperatorAccountStatus(){
        $value = $_GET['term'];
        if(empty($value)){
	        $data = [];
	        echo json_encode($data);
	        die;
        }
        else {
            $cooperatorId = current(explode(",", $value));
            $cooperator = $this->coop->get_active_cooperator($cooperatorId);
            
            if(!empty($cooperator)){
                $data['cooperator'] = $cooperator; //$cooperator->cooperator_staff_id . ', ' . $cooperator->cooperator_first_name . ' ' . $cooperator->cooperator_last_name;
                echo json_encode($data);
                die;
            }else{
                $data = [];
                echo json_encode($data);
                die;
            }
        }
    }

	public function storeLoanApplication()
	{
        
             
        helper(['form', 'date']);
        $data = [];
        //return dd($_POST);
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
	
	            $check_closure = $this->ac->check_ac(current(explode(",", $this->request->getVar('staff_id'))));
	
	
	            if(empty($check_closure)):
		            $cooperator = $this->coop->where(['cooperator_staff_id' => current(explode(",", $this->request->getVar('staff_id')))])->first();
		
				            if($cooperator['cooperator_status'] == 2):
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
										'staff_id'=>current(explode(",", $this->request->getVar('staff_id'))),
				                        'guarantor'=>current(explode(",", $this->request->getVar('guarantor_1'))),
				                        'name'=>substr($this->request->getVar('staff_id'), strlen(current(explode(" ", $this->request->getVar('staff_id'))))),
										'guarantor_2'=>current(explode(",", $this->request->getVar('guarantor_2'))),
										'loan_type'=>$this->request->getVar('loan_type'),
										'duration'=>$this->request->getVar('duration'),
				                        'amount'=>str_replace(",","",$this->request->getVar('amount')),
				                        'applied_date'=>date('Y-m-d H:i:s'),
				                        'attachment'=>$filename,
                                        'encumbrance_amount'=> $this->request->getVar('psr') == 1 ? ($this->request->getVar('psr_rate')/100) * str_replace(",","",$this->request->getVar('amount')) : 0, 
				                    ];
				                    // check loan type details with $loan_type
				                    $loan_setups = $this->loansetup->where(['loan_setup_id'=> $this->request->getVar('loan_type')])->first();
				                    if($loan_setups['psr'] == 1){
				                        $psr = $loan_setups['psr_value'];
				                        $staff_id = $this->request->getVar('staff_id');
				                        $ct = $this->ct->where(['contribution_type_regular' => 1])->first();
				                       $ct_id = $ct['contribution_type_id'];
				                        $ledgers =  $this->paymentdetail->where(['pd_staff_id' => $staff_id, 'pd_ct_id' => $ct_id])
				                        ->findAll();
				
				                        $bf = 0;
				                        if(!empty($ledgers)){
				                        foreach ($ledgers as $ledger):
				                                if($ledger['pd_drcrtype'] == 2):
				                                    $dr = $ledger['pd_amount'];
				                                    $cr = 0;
				
				                                endif;
				                                    if($ledger['pd_drcrtype'] == 1):
				                                        $cr = $ledger['pd_amount'];
				                                            $dr = 0;
				                                            endif;
				
				                                $bf = ($bf + $cr) - $dr;
				                        endforeach;
				
				                        }else{
				
				                            $bf = 0;
				                        }
				                        $psr_amount = ($psr/100)*(float)str_replace(",","",$this->request->getVar('amount'));
				
				                        if($psr_amount >= $bf){
				                            //loan verification can go through
				                            $this->loanapp->save($data);
				                            $alert = array(
				                                'msg' => 'Success! Loan application done.',
				                                'type' => 'success',
				                                'location' => site_url('/loan/new')
				                    
				                            );
				                            return view('pages/sweet-alert', $alert);
				                        }
				
				                    }
				                    else{
				                        $this->loanapp->save($data);
				                            $alert = array(
				                                'msg' => 'Success! Loan application done.',
				                                'type' => 'success',
				                                'location' => site_url('/loan/new')
				                    
				                            );
				                            return view('pages/sweet-alert', $alert);
				                    }
				                    
				              
					                
					                
					                
					                endif;
		
				           
				            if($cooperator['cooperator_status'] == 0):
					
								
					            $data = array(
						            'msg' => 'Account has been frozen',
						            'type' => 'error',
						            'location' => base_url('loan/new')
					
					            );
					
					            echo view('pages/sweet-alert', $data);
				            endif;
                    
                    else:
	
	
	                    $data = array(
		                    'msg' => 'Account is undergoing closure',
		                    'type' => 'error',
		                    'location' => base_url('loan/new')
	
	                    );
	
	                    echo view('pages/sweet-alert', $data);
	                    endif;




				
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
                        'verified_by'=> $this->user->where('username', $username)->first()['username'],
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
                        'approved_by'=> $this->user->where('username', $username)->first()['username'],
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
                        'created_at'=>date('Y-m-d H:i:s'),
                        'disburse'=>0,
                        'scheduled'=>0,
                        'loan_type'=>$this->request->getVar('loan_type'),
                        'encumbrance_amount'=>$application['encumbrance_amount'],
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
        $cart = $this->loan->getItemsInCart();
        //return dd($loan_apps);
        $data = [
            'loan_apps'=>$loan_apps,
            'coopbank'=>$coopbank,
            'withdraws'=>$withdraws,
            'cart'=>$cart
        ];
        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/new-payment-schedule', $data); 
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
                $this->loan->update($this->request->getVar('loan'), ['disburse'=>1, 'disburse_date'=>date('Y-m-d H:i:s')]);
                
                $payment = [
                    'pd_staff_id'=>$this->request->getVar('staff_id'),
                    'pd_transaction_date'=>date('Y-m-d H:i:s'),
                    'pd_narration'=>'Loan approved for disbursed.',
                    'pd_amount'=>$this->request->getVar('amount'),
                    'pd_drcrtype'=>1,
                    'pd_ct_id'=>3,
                    'pd_pg_id'=>1,
                    'pd_ref_code'=>substr(sha1(time()), 22,32)
                ];
                $this->paymentdetail->save($payment);
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
    
    public function get_active_loan(){
	    $staff_id = $_POST['staff_id'];
	    $ledgers = $this->loan->get_active_loans_staffid($staff_id);
	    $i = 0;
	    foreach ($ledgers as $ledger):
		
		    $total_cr = 0;
		    $total_dr = 0;
		    $cr = 0;
		    $dr = 0;
		
		    $total_interest = 0;
		
		    $loan_ledgers = $this->loan->get_loans_staff_id($staff_id, $ledger->loan_id);
		
		    if(!empty($loan_ledgers)):
			
			    foreach ($loan_ledgers as$loan_ledger):
				
				    if($loan_ledger->lr_dctype == 1):
					    $cr = $loan_ledger->lr_amount;
					    $total_cr = $total_cr + $cr;
				    endif;
				
				    if($loan_ledger->lr_dctype == 2):
					    $dr = $loan_ledger->lr_amount;
					    $total_dr = $total_dr + $dr;
				    endif;
				
				    if($loan_ledger->lr_interest == 1):
					    $total_interest = $total_interest + $loan_ledger->lr_amount;
				    endif;
			
			    endforeach;
		
		    else:
			
			    $loan_ledgers = $this->loan->get_loanss_staff_id($staff_id, $ledger->loan_id);
		
		    endif;
//
//		    $data['ledgers'][$i]  = array(
//			    'loan_description' => $loan_ledgers[0]->loan_description,
//			    'loan_principal' => $loan_ledgers[0]->amount,
//			    'loan_total_interest' => $total_interest,
//			    'loan_total_cr' => $total_cr,
//			    'loan_total_dr' => $total_dr,
//			    'loan_balance' => $loan_ledgers[0]->amount + ($total_dr - $total_cr),
//			    'loan_type' => $ledger->loan_id
//
//		    );
//
		    
		    $data[$i] = $ledger;
		    $data[$i]->loan_principal = number_format($loan_ledgers[0]->amount, 2);
		    $data[$i]->loan_balance = number_format($loan_ledgers[0]->amount + ($total_dr - $total_cr), 2);
		   
			   
		    $i++;
	    endforeach;
	    echo json_encode($data);
    }


    public function showApprovedLoanReports(){
        $data = [
            'applications'=>$this->loanapp->getAllApprovedLoanApplications()
        ];
    
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/report', $data); 
    }


    public function showDisapprovedLoanReportSection(){
        $data = [
            'applications'=>$this->loanapp->getAllDisapprovedLoanApplications()
        ];
    
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/disapproved-report', $data); 
    }


    public function showDisbursedLoanReportSection(){
        $data = [
            'applications'=>$this->loan->getAllDisbursedLoanReport()
        ];
    
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/disbursed-loan-report', $data); 
    }


    public function showApprovedLoanReportSection(){
        $data = [
            //'applications'=>$this->loanapp->getAllApprovedLoanApplications()
        ];
    
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/report-index', $data); 
    }


      public function generateLoanApplicationReport(){
        helper(['form']);
        $data = [];
        $from = $this->request->getVar('from') ?? date('Y-m-d');
        $to =  $this->request->getVar('to') ?? date('Y-m-d');
        
        if($_POST){
            $data = [
               'applications'=>$this->loanapp->getApprovedLoanApplicationReport($from, $to),
               'from'=>$from,
               'to'=>$to
            ];
            $username = $this->session->user_username;
           $this->authenticate_user($username, 'pages/loan/generated-report', $data);
        }
    }


      public function generateDisapprovedLoanApplicationReport(){
        helper(['form']);
        $data = [];
        $from = $this->request->getVar('from') ?? date('Y-m-d');
        $to =  $this->request->getVar('to') ?? date('Y-m-d');
        
        if($_POST){
            $data = [
               'applications'=>$this->loanapp->getDisapprovedLoanApplicationReport($from, $to),
               'from'=>$from,
               'to'=>$to
            ];
            $username = $this->session->user_username;
           $this->authenticate_user($username, 'pages/loan/generated-disapproved-report', $data);
        }
    }

   
}
