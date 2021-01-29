<?php namespace App\Controllers;
use App\Models\LoanApplicationModel; 
use \App\Models\Cooperators;
use \App\Models\LoanModel;
use \App\Models\LoanSetupModel;
use \App\Models\CoopBankModel;
use \App\Models\ScheduleMasterModel;
use \App\Models\ScheduleMasterDetailModel;

use \App\Models\MailModel;
use \App\Models\BulkSmsModel;

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
        $this->bulksms = new BulkSmsModel();
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
                    #send email
                    $this->email->setFrom('info@laukamz.com', 'laukamz');
                    $this->email->setTo('talktojoegee@gmail.com');
                    //            $this->email->setCC('another@another-example.com');
                    //            $this->email->setBCC('them@their-example.com');
                    $this->email->setSubject($this->request->getVar('subject'));
                    $this->email->setMailType('html');

                    //$booking = $this->booking->where(['booking_reg_id' => $_POST['reg_id']])->first();
                    //$location = $this->location->where(['location_id' => $booking['booking_location_id']])->first();


                    /* $data['location'] = $location['location_name'];
                    $data['date'] = $booking['booking_date'];
                    $data['name'] = $r['reg_last_name']." ".$r['reg_first_name'];
                    $data['time'] = $booking['booking_time'];
                    $data['serial_number'] = $booking['booking_serial_number'];

                    $serial_number = $booking['booking_serial_number'];
                    if($serial_number == null){

                        $serial_number = time();
                    }
                    $location_name = $location['location_name'];
                    $booking_date = $booking['booking_date'];
                    $booking_time = $booking['booking_time']; */

                    $data = [
                        'message'=>'Email body goes here'
                    ];

                    $body =  view('pages/email/email-campaign', $data);
                    $this->email->setMessage($body);
                    $this->email->send();

                    #end email send
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
        
         $data = [
            'sms'=>$this->bulksms->findAll(),
        ]; 
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/messaging/bulk-sms', $data);
    }

    public function sendBulkSms(){
        helper(['form']);
        $data = [];
        
        if($_POST){
            $rules = [
                'sender_id'=>[
                    'rules'=>'required',
                    'label'=>'Sender ID',
                    'errors'=>[
                        'required'=>'Sender ID is required'
                    ]
				],
                'receivers'=>[
                    'rules'=>'required',
                    'label'=>'Receivers',
                    'errors'=>[
                        'required'=>'Receivers field is required'
                    ]
				],
                'message'=>[
                    'rules'=>'required',
                    'label'=>'Message',
                    'errors'=>[
                        'required'=>'Message field is required'
                    ]
				],
            ];
            if($this->validate($rules)){
					$data = [
                        'sender_id'=>$this->request->getVar('sender_id'),
                        'receivers'=>$this->request->getVar('receivers'),
                        'message'=>$this->request->getVar('message')
					];
                    $this->bulksms->save($data);
                    #send mail
                    $ozMessageData = str_replace(" ", '%20', $this->request->getVar('message'));
                    $message = 'Message'; //$this->request->getVar('message');
                    $to = $this->request->getVar('receivers');
                    $sender_id = $this->request->getVar('sender_id');
                    $api_token = 'Z7ktaYTC58OmVFgKPvNvb6P6dRK6A5K38fapOIJ5cYs4kqFcX3JTEcl2KTgf';
                    //$api_token = '54vBqnPgNI3ICsCFGfSskbJqxKWfW1VRx8VEpiQA836GqaiHSAx5StevKrZa';
                    //$url = 'https://www.bulksmsnigeria.com/api/v1/sms/create?api_token='.$api_token.'&from='.$sender_id.'&to='.$to.'&body='.$ozMessageData.'&dnd=2';
                    $url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=Z7ktaYTC58OmVFgKPvNvb6P6dRK6A5K38fapOIJ5cYs4kqFcX3JTEcl2KTgf&from=BulkSMS.ng&to=2348032404359&body=Welcome&dnd=2";
                    //$response = $this->client->get($url);

                    print_r($response);
                    $alert = array(
                        'msg' => 'Success! SMS sent.',
                        'type' => 'success',
                        'location' => site_url('/messaging/bulk-sms')
                    );
                    return view('pages/sweet-alert', $alert);
            }else{
                return $this->response->redirect(site_url('/messaging/bulk-sms'));
            }
        }
    }
}
