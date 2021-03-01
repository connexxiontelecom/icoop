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
use App\Models\CustomerSetupModel; 
use App\Models\CustomerReceivableModel; 

class ThirdpartyReceivableController extends BaseController
{

     public function __construct(){
        $this->session = session();
        $this->coa = new CoaModel;
        $this->coopbank = new CoopBankModel;
        $this->customersetup = new CustomerSetupModel;
        $this->customerreceivable = new CustomerReceivableModel;
    }

    public function showCustomerSetupForm(){
        $data = [
          'accounts'=> $this->coa->where('type',1)->findAll()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/customer-setup', $data);
    }

    public function storeCustomerSetup(){
        helper(['form']);
        $data = [];
        if($_POST){
            $data = [
                    'customer_name'=>$this->request->getVar('customer_name'),
                    'contact_person'=>$this->request->getVar('contact_person'),
                    'email'=>$this->request->getVar('email') ,
                    'phone_no'=>$this->request->getVar('phone_no'),
                    'gl_account_code'=>$this->request->getVar('gl_account_code')
					];
					$this->customersetup->save($data);
					$alert = array(
                            'msg' => 'Success! Customer setup done.',
                            'type' => 'success',
                            'location' => site_url('/third-party/receivable/customer-setup-list')
                        );
            return view('pages/sweet-alert', $alert);
        }
    }

    public function editCustomerSetup(){
        helper(['form']);
        $data = [];
        if($_POST){
            $data = [
                    'customer_setup_id'=>$this->request->getVar('customer_id'),
                    'customer_name'=>$this->request->getVar('customer_name'),
                    'contact_person'=>$this->request->getVar('contact_person'),
                    'email'=>$this->request->getVar('email') ,
                    'phone_no'=>$this->request->getVar('phone_no'),
                    'gl_account_code'=>$this->request->getVar('gl_account_code')
					];
					$this->customersetup->save($data);
					$alert = array(
                            'msg' => 'Success! Changes saved.',
                            'type' => 'success',
                            'location' => site_url('/third-party/receivable/customer-setup-list')
                        );
            return view('pages/sweet-alert', $alert);
        }
    }

    public function customerSetupList(){
        $data = [
            'customer_setups' => $this->customersetup->getCustomerSetupList(),
            'accounts'=> $this->coa->where('type',1)->findAll()
        ];
         $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/customer-setup-list', $data);
    }


    public function showNewReceivableForm(){
        $data = [
          'customers'=>$this->customersetup->findAll(),
          'coopbanks'=>$this->coopbank->getCoopBanks(),
          'coas'=>$this->coa->where('type',1)->findAll()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/new-receivable', $data);
    }

    public function storeNewCustomerReceivable(){
        helper(['form']);
        $data = [];
        if($_POST){
            $data = [
                    'cr_transaction_date'=>$this->request->getVar('transaction_date'),
                    'cr_coop_bank_id'=>$this->request->getVar('coop_bank'),
                    'cr_amount'=>str_replace(",","",$this->request->getVar('amount')) ,
                    'cr_purpose'=>$this->request->getVar('purpose'),
                    'cr_customer_setup_id'=>$this->request->getVar('customer'),
                    'cr_gl_cr'=>$this->request->getVar('gl_cr')
					];
					$this->customerreceivable->save($data);
					$alert = array(
                            'msg' => 'Success! New customer receivable saved.',
                            'type' => 'success',
                            'location' => site_url('/third-party/receivable/customer-setup-list')
                        );
            return view('pages/sweet-alert', $alert);
        }
    }

    public function showUnverifiedReceivable(){ 
        $data = [
          'receivables'=>$this->customerreceivable->getUnverifiedReceivables()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/unverified-receivables', $data);
    }
    public function showVerifiedReceivable(){ 
        $data = [
          'receivables'=>$this->customerreceivable->getVerifiedReceivables()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/verified-receivables', $data);
    }


    public function approveDeclineReceivable(){
        helper(['form']);
        $data = [];
        if($_POST){
            if($this->request->getVar('receivable_status') == 'verified'){
                $data = [
                    'customer_receivable_id'=>$this->request->getVar('customer_receivable'),
                    'cr_verify'=>1,
                    'cr_date_verified'=>date('Y-m-d H:i:s'),
                    'cr_verified_by'=>'Joseph' 
                ];

            }else{
                $data = [
                    'customer_receivable_id'=>$this->request->getVar('customer_receivable'),
                    'cr_approve'=>1,
                    'cr_date_approve'=>date('Y-m-d H:i:s'),
                    'cr_approved_by'=>'Joseph' 
                ];
            }
					$this->customerreceivable->save($data);
					$alert = array(
                            'msg' => 'Success! Customer receivable '.$this->request->getVar('receivable_status'),
                            'type' => 'success',
                            'location' => site_url('/third-party/receivable/customer-setup-list')
                        );
            return view('pages/sweet-alert', $alert);
        }
    }
    
}
