<?php 
namespace App\Controllers;
use App\Models\Applications;
use App\Models\Banks;
use App\Models\DepartmentModel;
use App\Models\PayrollGroups;
use App\Models\StateModel;
use App\Models\UserModel;
use App\Models\LoanApplicationModel;
use App\Models\WithdrawModel;
use App\Models\AccountClosureModel;
use App\Models\JournalTransferMasterModel;
use CodeIgniter\RESTful\ResourceController;


class HelpDeskController extends BaseController
{
    public function __construct(){

        $this->state = new StateModel();
        $this->department = new DepartmentModel();
        $this->application = new Applications();
        $this->bank = new Banks();
        $this->pg = new PayrollGroups();
        $this->loanapp = new LoanApplicationModel();
        $this->withdraw = new WithdrawModel();
        $this->closure = new AccountClosureModel();
        $this->journal = new JournalTransferMasterModel();
        $this->session = session();

    }
    
    public function getLoanApplication(){
       $data = [
           'loans'=>$this->loanapp->getAllLoanApplications()
       ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/help-desk/loan-application', $data);
    }

    public function getWithdrawApplication(){
       $data = [
           'withdraws'=>$this->withdraw->getAllWithdrawApplications()
       ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/help-desk/withdraw-application', $data);
    }

    public function getAccountClosureApplication(){
       $data = [
           'closures'=>$this->closure->getAllAccountClosureApplications()
       ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/help-desk/closure-application', $data);
    }
    public function getJournalTransferApplication(){
       $data = [
          'journals'=>$this->journal->getAllJournalTransferApplications()
       ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/help-desk/journal-transfer', $data);
    }

}
