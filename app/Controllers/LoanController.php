<?php namespace App\Controllers;
use App\Models\LoanApplicationModel; 
use \App\Models\Cooperators;
use \App\Models\LoanSetupModel;

class LoanController extends BaseController
{

    public function __construct(){
        $this->session = session();
		$this->loanapp = new LoanApplicationModel();
		$this->coop = new Cooperators();
        $this->loansetup = new LoanSetupModel();
        $this->session = session();
    }

	public function showLoanApplicationForm()
	{
        $data = [];
        $data = [
            'loan_types'=>$this->loansetup->findAll()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/new', $data);
    }
    
    public function getCooperator($id){
        $cooperator = $this->coop->where('cooperator_staff_id', $id)->first();
        return json_encode($cooperator);
    }
    public function getLoanType($id){
        $setup = $this->loansetup->where('loan_setup_id', $id)->first();
        return json_encode($setup);
    }

	public function storeLoanApplication()
	{
     
        helper(['form']);
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
            'applications'=>$this->loanapp->where('verify',0)->findAll(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/verify', $data);
    }

    public function verifyLoanApplication(){
        helper(['form']);
        $data = [];

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
                        'verify'=>1
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
            'applications'=>$this->loanapp->where('verify',1)->where('approve',0)->findAll(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/approve', $data);
    }

    public function approveLoanApplication(){
        helper(['form']);
        $data = [];

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
                        'verify'=>1
					];
					$this->loanapp->update($this->request->getVar('application_id'), $data);
            
                    $alert = array(
                        'msg' => 'Success! Loan application approved.',
                        'type' => 'success',
                        'location' => site_url('/loan/verify')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                return $this->response->redirect(site_url('/loan/verify'));
            }
        }
    }
	
    public function viewLoanApplication($id){
        $data = [];
        $application = $this->loanapp->where('loan_app_id', $id)->first();
        $setup = $this->loansetup->where('loan_setup_id', $application['loan_type'])->first();

        $data = [
            'application'=>$application,
            'setup'=>$setup
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/view-loan-application', $data);
    }

    public function showPaymentSchedule(){
        $data = [];
        $loan_apps = $this->loanapp->where('approve',1)->findAll();
        $data = [
            'loan_apps'=>$loan_apps
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/new-payment-schedule', $data); 
    }
}
