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
                'name'=>[
                    'rules'=>'required',
                    'label'=>'Name',
                    'errors'=>[
                        'required'=>'Name is required'
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
                'loan_terms'=>[
                    'rules'=>'required',
                    'label'=>'Loan terms',
                    'errors'=>[
                        'required'=>'Loan terms is required'
                    ]
					],
                'guarantor'=>[
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
						'guarantor_2'=>$this->request->getVar('guarantor_2'),
						'loan_type'=>$this->request->getVar('loan_type'),
						'duration'=>$this->request->getVar('duration'),
						'amount'=>str_replace(",","",$this->request->getVar('amount')),
						//'loan_terms'=>$this->request->getVar('loan_terms'),
						'guarantor'=>$this->request->getVar('guarantor')
					];
					$this->loanapp->save($data);
					return $this->response->redirect(site_url('/loan/new'));
				
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
					return $this->response->redirect(site_url('/loan/verify'));
				
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
					return $this->response->redirect(site_url('/loan/verify'));
				
            }else{
                return $this->response->redirect(site_url('/loan/verify'));
            }
        }
    }
	
    public function viewLoanApplication($id){
        $data = [];
        $application = $this->loanapp->where('loan_app_id', $id)->first();
        $data = [
            'application'=>$application
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/loan/view-loan-application', $data);
    }
}
