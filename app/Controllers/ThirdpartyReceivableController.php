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
use App\Models\ReceiptMasterModel; 

class ThirdpartyReceivableController extends BaseController
{

     public function __construct(){
        $this->session = session();
        $this->coa = new CoaModel;
        $this->coopbank = new CoopBankModel;
        $this->gl = new GlModel;
        $this->customersetup = new CustomerSetupModel;
        $this->customerreceivable = new CustomerReceivableModel;
        $this->receiptmaster = new ReceiptMasterModel;
        $this->user = new UserModel();
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
        $username = $this->session->user_username;
	    $user = $this->user->where('username', $username)->first();
	    
        if($_POST){
            if($this->request->getVar('receivable_status') == 'verified'){
                $data = [
                    'customer_receivable_id'=>$this->request->getVar('customer_receivable'),
                    'cr_verify'=>1,
                    'cr_date_verified'=>date('Y-m-d H:i:s'),
                    'cr_verified_by'=>$user['user_id']
                ];

            }else{
            	$receivable_id = $this->request->getVar('customer_receivable');

                $data = [
                    'customer_receivable_id'=>$this->request->getVar('customer_receivable'),
                    'cr_approve'=>1,
                    'cr_date_approved'=>date('Y-m-d H:i:s'),
                    'cr_approved_by'=>$user['user_id']
                ];

                #customer
                $receivables = $this->customerreceivable->where('customer_receivable_id', $receivable_id)->first();

                $customerGl = $this->customersetup->getCustomerDetails($this->request->getVar('customer_setup'));

                $bank = $this->coopbank->getBank($receivables['cr_coop_bank_id']);
                $ref = time();


	            $d_account = $this->coa->where('glcode', $bank->glcode)->first();

	            $c_account = $this->coa->where('glcode', $customerGl->gl_account_code)->first();

	            $bankGl = array(
		            'glcode' => $d_account['glcode'],
		            'posted_by' => $this->session->user_username,
		            'narration' => 'Third Party Receipt from '.$customerGl->customer_name,
		            'dr_amount' => $receivables['cr_amount'],
		            'cr_amount' => 0,
		            'ref_no' =>$ref,
		            'bank' => $d_account['bank'],
		            'ob' => 0,
		            'posted' => 1,
		            'gl_transaction_date' =>$receivables['cr_transaction_date'],
		            'created_at' => date('Y-m-d'),
		            'gl_description' => 'Third Party Receipt from '.$customerGl->customer_name,

	            );
	            $this->gl->save($bankGl);



	            $bankGl = array(
		            'glcode' => $c_account['glcode'],
		            'posted_by' => $this->session->user_username,
		            'narration' => 'Third Party Receipt from '.$customerGl->customer_name,
		            'dr_amount' => 0,
		            'cr_amount' => $receivables['cr_amount'],
		            'ref_no' =>$ref,
		            'bank' => $c_account['bank'],
		            'ob' => 0,
		            'posted' => 1,
		            'gl_transaction_date' =>$receivables['cr_transaction_date'],
		            'created_at' => date('Y-m-d'),
		            'gl_description' => 'Third Party Receipt from '.$customerGl->customer_name,

	            );
	            $this->gl->save($bankGl);

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

    public function report(){
        $from = date('Y-m-d');
        $to =   date('Y-m-d');
         $data = [
          'result'=>$this->customerreceivable->generateThirdPartyReport($from, $to),
          'from'=>$from,
          'to'=>$to,
          'accounts'=> $this->coa->where('type',1)->findAll()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/3rd-party-report', $data);
    }



    public function generateReport(){ //this is third-party report
        helper(['form']);
        $data = [];
        $from = $this->request->getVar('from') ?? date('Y-m-d');
        $to =  $this->request->getVar('to') ?? date('Y-m-d');
        if($_POST){
            $data = [
                'result'=>$this->customerreceivable->generateThirdPartyReport($from, $to),
                'from'=>$from,
                'to'=>$to,
                'accounts'=> $this->coa->where('type',1)->findAll()
            ];
            $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/3rd-party-report', $data);
        }
    }

    public function memberReport(){
        $from = date('Y-m-d');
        $to =   date('Y-m-d');
         $data = [
          'result'=>$this->receiptmaster->generateMemberReport($from, $to),
          'from'=>$from,
          'to'=>$to
        ];        
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/member-report', $data);
    }

    public function generateMemberReport(){
        helper(['form']);
        $data = [];
        $from = $this->request->getVar('from') ?? date('Y-m-d');
        $to =  $this->request->getVar('to') ?? date('Y-m-d');
        if($_POST){
            $data = [
                'result'=>$this->receiptmaster->generateMemberReport($from, $to),
                'from'=>$from,
                'to'=>$to,
                'accounts'=> $this->coa->where('type',1)->findAll()
            ];
            //return dd($data['result']);
            $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/receivables/member-report', $data);
        }
    }



    public function viewThirdpartyReceipt($id){
        $receipt = $this->customerreceivable->getThirdpartyReceiptById($id);
        if(!empty($receipt)){
            $data = [
                'receipt'=>$receipt
            ];
            //return dd($data);
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/receivables/3rd-party-receipt', $data);
        }else{
            $alert = array(
                'msg' => 'Ooops! No record found.',
                'type' => 'error',
                'location' => site_url('/third-party/receivable/report')
            );
            return view('pages/sweet-alert', $alert);
        }
    }
    public function viewMemberyReceipt($id){
        $receipt = $this->receiptmaster->getReceiptDetailsById($id);
        if(!empty($receipt)){
            $data = [
                'receipt'=>$receipt
            ];
           
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/receivables/member-receipt', $data);
        }else{
            $alert = array(
                'msg' => 'Ooops! No record found.',
                'type' => 'error',
                'location' => site_url('/third-party/receivable/report')
            );
            return view('pages/sweet-alert', $alert);
        }
    }
    public function emailThirdpartyReceipt($id){
        $receipt = $this->customerreceivable->getThirdpartyReceiptById($id);
        if(!empty($receipt)){
            #Send email
            $this->email->setFrom('info@connexxiontelecom.com', 'iCoop');
            $this->email->setTo('talktojoegee@gmail.com');
        //$this->email->setTo($receipt->email);
            $this->email->setSubject('Receipt from iCoop');
            $this->email->setMailType('html');
            
            $data['customer_name'] = $receipt->customer_name ?? '';
            $data['transaction_date'] = $receipt->cr_transaction_date ?? '';
            $data['account_name'] = $receipt->account_name ?? '';
            $data['account_no'] = $receipt->account_no ?? '';
            $data['amount'] = $receipt->cr_amount ?? '';
            $body =  view('pages/receivables/receipt-email-template', $data);
            $this->email->setMessage($body);
            $this->email->send();
            $alert = array(
                'msg' => 'Success! Receipt sent via mail.',
                'type' => 'success',
                'location' => site_url('/third-party/receivable/report')
            );
            return view('pages/sweet-alert', $alert);
        }else{
            $alert = array(
                'msg' => 'Ooops! No record found.',
                'type' => 'error',
                'location' => site_url('/third-party/receivable/report')
            );
            return view('pages/sweet-alert', $alert);
        }
    }
    
}
