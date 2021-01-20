<?php namespace App\Controllers;
use App\Models\LoanApplicationModel; 
use \App\Models\Cooperators;
use \App\Models\LoanModel;
use \App\Models\LoanSetupModel;
use \App\Models\CoopBankModel;
use \App\Models\ScheduleMasterModel;
use \App\Models\ScheduleMasterDetailModel;

use \App\Models\MailModel;

class MessagingController extends BaseController
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
        #
        $this->mail = new MailModel();
        $this->session = session();
    }

	public function showComposeEmailView()
	{
        $data = [];
        $data = [
            'loan_types'=>$this->loansetup->findAll(),
            'cooperators'=>$this->coop->findAll()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/messaging/compose-email', $data);
    }
	public function showMails()
	{
        $data = [];
        $data = [
            'mails'=>$this->mail->getMails(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/messaging/mails', $data);
    }

    public function sendEmail(){
        helper(['form']);
        $data = [];
        
        if($_POST){
            $rules = [
                'message'=>[
                    'rules'=>'required',
                    'label'=>'Message body',
                    'errors'=>[
                        'required'=>'Message body is required'
                    ]
				],
                'subject'=>[
                    'rules'=>'required',
                    'label'=>'Subject',
                    'errors'=>[
                        'required'=>'Subject is required'
                    ]
				],
                'receivers'=>[
                    'rules'=>'required',
                    'label'=>'Receivers',
                    'errors'=>[
                        'required'=>'Receiver is required'
                    ]
				],
            ];
            if($this->validate($rules)){
					$data = [
                        'subject'=>$this->request->getVar('subject'),
                        'body'=>$this->request->getVar('message'),
                        'sent_by'=>1,
					];
                    $this->mail->save($data);
            
                    $alert = array(
                        'msg' => 'Success! Mail sent.',
                        'type' => 'success',
                        'location' => site_url('/messaging/mails')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                return $this->response->redirect(site_url('/messaging/mails'));
            }
        }
    }
    
    public function openMail($id){
        $data = [
            'mail'=>$this->mail->getMail($id)
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/messaging/mail', $data);
    }
    public function showBulkSms()
	{
        $data = [];
       /*  $data = [
            'mails'=>$this->mail->getMails(),
        ]; */
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/messaging/bulk-sms', $data);
    }
}
