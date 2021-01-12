<?php namespace App\Controllers;
use App\Models\StateModel; 
use App\Models\PolicyConfigModel; 
use App\Models\CoaModel; 
use App\Models\LoanSetupModel; 

class LoanController extends BaseController
{

    public function __construct(){
        $this->session = session();
		$this->policy = new PolicyConfigModel();
		$this->coa = new CoaModel();
		$this->loan = new LoanSetupModel();
    }

	public function showLoanApplicationForm()
	{
		return view('welcome_message');
	}

	

}
