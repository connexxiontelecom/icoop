<?php 
namespace App\Controllers;
use App\Models\StateModel; 
use App\Models\PolicyConfigModel; 
use App\Models\CoaModel; 

class Policyconfigcontroller extends BaseController
{
	public function __construct(){
        $this->session = session();
		$this->policy = new PolicyConfigModel();
		$this->coa = new CoaModel();
	}
    
	public function index()
	{
        $data = [];
        //$states = new StateModel;
		//$data['states'] = $states->findAll();
        $data['accounts'] = $this->coa->findAll();
        $data['profile'] = $this->policy->first();
		return view('pages/policy-config/index', $data);
	}

	public function updateProfile(){
		helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'company_name'=>[
                    'rules'=>'required',
                    'label'=>'Company name',
                    'errors'=>[
                        'required'=>'Enter company name'
                    ]
					],
                'signature_1'=>[
                    'rules'=>'required',
                    'label'=>'Authorized signature 1',
                    'errors'=>[
                        'required'=>'Authorized signature 1 is required'
                    	]
					],
                'signature_2'=>[
                    'rules'=>'required',
                    'label'=>'Authorized signature 2',
                    'errors'=>[
                        'required'=>'Authorized signature 2 is required'
                    	]
					],
                'signature_3'=>[
                    'rules'=>'required',
                    'label'=>'Authorized signature 3',
                    'errors'=>[
                        'required'=>'Authorized signature 3 is required'
                    	]
					],
            ];
            if($this->validate($rules)){
				$policy = $this->policy->first();
				if(empty($policy)){
					$data = [
						'company_name'=>$this->request->getVar('company_name'),
						'signature_1'=>$this->request->getVar('signature_1'),
						'signature_2'=>$this->request->getVar('signature_2'),
						'signature_3'=>$this->request->getVar('signature_3'),
					];
					$this->policy->save($data);
					return $this->response->redirect(site_url('/policy-config'));
				}else{
					$data = [
						'company_name'=>$this->request->getVar('company_name'),
						'signature_1'=>$this->request->getVar('signature_1'),
						'signature_2'=>$this->request->getVar('signature_2'),
						'signature_3'=>$this->request->getVar('signature_3'),
					];
					$this->policy->update($policy['policy_config_id'], $data);
					return $this->response->redirect(site_url('/policy-config'));
				}
				
            }else{
                return $this->response->redirect(site_url('/policy-config'));
            }
        }

	}
	public function savingsRate(){
		helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'minimum_saving'=>[
                    'rules'=>'required',
                    'label'=>'Minimum name',
                    'errors'=>[
                        'required'=>'Enter minimum savings is required'
                    ]
					],
                'registration_fee'=>[
                    'rules'=>'required',
                    'label'=>'Registration fee',
                    'errors'=>[
                        'required'=>'Registration fee is required'
                    	]
					],
                'savings_interest_rate'=>[
                    'rules'=>'required',
                    'label'=>'Savings interest rate',
                    'errors'=>[
                        'required'=>'Savings interest rate is required'
                    	]
					],
                'savings_withdrawal_charge'=>[
                    'rules'=>'required',
                    'label'=>'Savings withdrawal charge',
                    'errors'=>[
                        'required'=>'Savings withdrawal charge is required'
                    	]
					],
            ];
            if($this->validate($rules)){
				$policy = $this->policy->first();
				if(empty($policy)){
					$data = [
						'minimum_saving'=>$this->request->getVar('minimum_saving'),
						'registration_fee'=>$this->request->getVar('registration_fee'),
						'savings_interest_rate'=>$this->request->getVar('savings_interest_rate'),
						'savings_withdrawal_charge'=>$this->request->getVar('savings_withdrawal_charge'),
					];
					$this->policy->save($data);
					return $this->response->redirect(site_url('/policy-config'));
				}else{
					$data = [
						'minimum_saving'=>$this->request->getVar('minimum_saving'),
						'registration_fee'=>$this->request->getVar('registration_fee'),
						'savings_interest_rate'=>$this->request->getVar('savings_interest_rate'),
						'savings_withdrawal_charge'=>$this->request->getVar('savings_withdrawal_charge'),
					];
					$this->policy->update($policy['policy_config_id'], $data);
					return $this->response->redirect(site_url('/policy-config'));
				}
				
            }else{
                return $this->response->redirect(site_url('/policy-config'));
            }
        }

	}

	public function savingGlConfig(){
		helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'contribution_payroll_cr'=>[
                    'rules'=>'required',
                    'label'=>'Contribution payroll CR',
                    'errors'=>[
                        'required'=>'Select GL for Contribution payroll CR'
                    ]
					],
                'contribution_external_cr'=>[
                    'rules'=>'required',
                    'label'=>'Contribution external CR',
                    'errors'=>[
                        'required'=>'Select GL for Contribution external CR'
                    ]
					],
                'withdrawal_dr'=>[
                    'rules'=>'required',
                    'label'=>'Withdrawal DR',
                    'errors'=>[
                        'required'=>'Select Withdrawal DR'
                    ]
					],
                'registration_fee_dr'=>[
                    'rules'=>'required',
                    'label'=>'Registration fee DR',
                    'errors'=>[
                        'required'=>'Select registration fee DR'
                    ]
					],
                'registration_fee_cr'=>[
                    'rules'=>'required',
                    'label'=>'Registration fee CR',
                    'errors'=>[
                        'required'=>'Select registration fee CR'
                    ]
					],
                'income_savings_withdrawal_charge_dr'=>[
                    'rules'=>'required',
                    'label'=>'Income savings withdrawal charge',
                    'errors'=>[
                        'required'=>'Income savings withdrawal charge DR is required'
                    ]
					],
                'income_savings_withdrawal_charge_cr'=>[
                    'rules'=>'required',
                    'label'=>'Income savings withdrawal charge',
                    'errors'=>[
                        'required'=>'Income savings withdrawal charge CR is required'
                    ]
					],
            ];
            if($this->validate($rules)){
				$policy = $this->policy->first();
				if(empty($policy)){
					$data = [
						'contribution_payroll_cr'=>$this->request->getVar('contribution_payroll_cr'),
						'contribution_external_cr'=>$this->request->getVar('contribution_external_cr'),
						'savings_withdrawal_charge'=>$this->request->getVar('savings_withdrawal_charge'),
						'withdrawal_dr'=>$this->request->getVar('withdrawal_dr'),
						'registration_fee_dr'=>$this->request->getVar('registration_fee_dr'),
						'registration_fee_cr'=>$this->request->getVar('registration_fee_cr'),
						'income_savings_withdrawal_charge_dr'=>$this->request->getVar('income_savings_withdrawal_charge_dr'),
						'income_savings_withdrawal_charge_cr'=>$this->request->getVar('income_savings_withdrawal_charge_cr')
					];
					$this->policy->save($data);
					return $this->response->redirect(site_url('/policy-config'));
				}else{
					$data = [
						'contribution_payroll_cr'=>$this->request->getVar('contribution_payroll_cr'),
						'contribution_external_cr'=>$this->request->getVar('contribution_external_cr'),
						'savings_withdrawal_charge'=>$this->request->getVar('savings_withdrawal_charge'),
						'withdrawal_dr'=>$this->request->getVar('withdrawal_dr'),
						'registration_fee_dr'=>$this->request->getVar('registration_fee_dr'),
						'registration_fee_cr'=>$this->request->getVar('registration_fee_cr'),
						'income_savings_withdrawal_charge_dr'=>$this->request->getVar('income_savings_withdrawal_charge_dr'),
						'income_savings_withdrawal_charge_cr'=>$this->request->getVar('income_savings_withdrawal_charge_cr')
					];
					$this->policy->update($policy['policy_config_id'], $data);
					return $this->response->redirect(site_url('/policy-config'));
				}
				
            }else{
                return $this->response->redirect(site_url('/policy-config'));
            }
        }

	}
	public function loanSetup(){
		helper(['form']);
        $data = [];

        if($_POST){
            $rules = [
                'loan_description'=>[
                    'rules'=>'required',
                    'label'=>'Loan description',
                    'errors'=>[
                        'required'=>'Loan description required'
                    ]
					],
                'qualification_age'=>[
                    'rules'=>'required',
                    'label'=>'Qualification age',
                    'errors'=>[
                        'required'=>'Qualification age is required'
                    ]
					],
                'min_credit_limit'=>[
                    'rules'=>'required',
                    'label'=>'Minimum credit limit',
                    'errors'=>[
                        'required'=>'Minimum credit limit is required'
                    ]
					],
                'max_credit_limit'=>[
                    'rules'=>'required',
                    'label'=>'Maximum credit limit',
                    'errors'=>[
                        'required'=>'Maximum credit limit is required'
                    ]
					],
                'max_repayment_periods'=>[
                    'rules'=>'required',
                    'label'=>'Maximum repayment periods',
                    'errors'=>[
                        'required'=>'Maximum repayment periods is required'
                    ]
					],
                'interest_rate'=>[
                    'rules'=>'required',
                    'label'=>'Interest Rate',
                    'errors'=>[
                        'required'=>'Interest Rate is required'
                    ]
					],
                'interest_method'=>[
                    'rules'=>'required',
                    'label'=>'Interest method',
                    'errors'=>[
                        'required'=>'Interest method is required'
                    ]
					],
                'loan_gl_account_number'=>[
                    'rules'=>'required',
                    'label'=>'Loan GL Account Number',
                    'errors'=>[
                        'required'=>'Loan GL Account Number is required'
                    ]
					],
                'loan_unearned_int_gl_account_no'=>[
                    'rules'=>'required',
                    'label'=>'Loan Unearned Int. GL Account Number',
                    'errors'=>[
                        'required'=>'Loan Unearned Int. GL Account Number is required'
                    ]
					],
                'loan_int_income_gl_account_no'=>[
                    'rules'=>'required',
                    'label'=>'Loan Int. Income GL Account Number',
                    'errors'=>[
                        'required'=>'Loan Int. Income GL Account Number is required'
                    ]
					],
                'loan_terms'=>[
                    'rules'=>'required',
                    'label'=>'Loan Terms',
                    'errors'=>[
                        'required'=>'Loan Terms is required'
                    ]
					],
            ];
            if($this->validate($rules)){
				$policy = $this->policy->first();
				if(empty($policy)){
					$data = [
						'contribution_payroll_cr'=>$this->request->getVar('contribution_payroll_cr'),
						'contribution_external_cr'=>$this->request->getVar('contribution_external_cr'),
						'savings_withdrawal_charge'=>$this->request->getVar('savings_withdrawal_charge'),
						'withdrawal_dr'=>$this->request->getVar('withdrawal_dr'),
						'registration_fee_dr'=>$this->request->getVar('registration_fee_dr'),
						'registration_fee_cr'=>$this->request->getVar('registration_fee_cr'),
						'income_savings_withdrawal_charge_dr'=>$this->request->getVar('income_savings_withdrawal_charge_dr'),
						'income_savings_withdrawal_charge_cr'=>$this->request->getVar('income_savings_withdrawal_charge_cr')
					];
					$this->policy->save($data);
					return $this->response->redirect(site_url('/policy-config'));
				}else{
					$data = [
						'contribution_payroll_cr'=>$this->request->getVar('contribution_payroll_cr'),
						'contribution_external_cr'=>$this->request->getVar('contribution_external_cr'),
						'savings_withdrawal_charge'=>$this->request->getVar('savings_withdrawal_charge'),
						'withdrawal_dr'=>$this->request->getVar('withdrawal_dr'),
						'registration_fee_dr'=>$this->request->getVar('registration_fee_dr'),
						'registration_fee_cr'=>$this->request->getVar('registration_fee_cr'),
						'income_savings_withdrawal_charge_dr'=>$this->request->getVar('income_savings_withdrawal_charge_dr'),
						'income_savings_withdrawal_charge_cr'=>$this->request->getVar('income_savings_withdrawal_charge_cr')
					];
					$this->policy->save($data);
					return $this->response->redirect(site_url('/policy-config'));
				}
				
            }else{
                return $this->response->redirect(site_url('/policy-config'));
            }
        }

	}


    

    
}
