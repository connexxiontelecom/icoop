<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CoaModel;
use App\Models\JournalVoucherModel;
use App\Models\GlModel;

class JournalVoucher extends BaseController
{
    public function __construct(){
        $this->coa = new CoaModel();
        $this->jv = new JournalVoucherModel();
        $this->gl = new GlModel();
        $this->session = session();
    }
	public function index()
	{
        $data['charts'] = $this->coa->findAll();
        $data['entries'] = $this->jv->where('posted',0)->where('trash',0)->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/jv/index',$data);
    }
    
	public function create(){
        $username = $this->session->user_username;
        $jv_entry = "JV".rand(10,100);
        while($this->jv->find(['ref_no' => $jv_entry])):
	        $jv_entry = "JV".rand(10,100);
	        
	        endwhile;
	     $data['jv_entry'] = $jv_entry;
        $data['accounts'] = $this->coa->findAll();
        $this->authenticate_user($username, 'pages/jv/create',$data);
    }

    public function view($id){
        $username = $this->session->user_username;
        $data['entry'] = $this->jv->where('journal_id', $id)->first();
        $this->authenticate_user($username, 'pages/jv/view',$data);
    }
    public function post($id){
        $journal = $this->jv->where('journal_id', $id)->first();
        if(!empty($journal)){
            $dateTime = date('Y-m-d H:i:s');
            $data = [
                'posted'=>1,
                'posted_date'=>$dateTime
            ];
            $this->jv->update($id, $data);

            $account = $this->coa->where('glcode', $journal['glcode'])->first();
            $bankGl = [
                'glcode' => $journal['glcode'],
                'posted_by' => 1,
                'narration' => $journal['narration'] ?? '',
                'dr_amount' => $journal['dr_amount'] > 0 ? $journal['dr_amount'] : 0,
                'cr_amount' => $journal['cr_amount'] > 0 ? $journal['cr_amount'] : 0,
                'ref_no' => $journal['ref_no'] ?? '',
                'bank' => $account['bank'],
                'ob' => 0,
                'posted' => 1,
                'created_at' => $journal['jv_date'],
            ];
            $this->gl->save($bankGl);            
            return $this->response->redirect(site_url('/journal-voucher'));
        }else{
            return $this->response->redirect(site_url('/journal-voucher'));
        }
    }
    public function decline($id){
        $journal = $this->jv->where('journal_id', $id)->first();
        $data = [
            'trash'=>1
        ];
        $this->jv->update($id, $data);
        return $this->response->redirect(site_url('/journal-voucher'));
    }
    
    public function store(){
        $rules = [
            'issue_date'=>[
                'rules'=>'required',
                'label'=>'Issue name',
                'errors'=>[
                    'required'=>'Enter issue date'
                ]
            ],
            'entry_no'=>[
                'rules'=>'required',
                'label'=>'Entry No.',
                'errors'=>[
                    'required'=>'Entry is required'
                ]
            ]
        ];
        $cr_total = 0;
        $dr_total = 0;
        //return dd($this->request->getPost('credit_amount'));
        for($i = 0; $i<count($this->request->getPost('debit_amount')); $i++){
            $cr_total +=  $_POST['credit_amount'][$i];
            $dr_total += $_POST['debit_amount'][$i];
        }
         $ref_no = substr(sha1(time()), 32,40);
        if($cr_total == $dr_total){
            $data = [];
            for($n = 0; $n<count($this->request->getVar('account')); $n++){
                $data = [
                    'glcode' => $_POST['account'][$n],
                    'narration' => $_POST['narration'][$n],
                    'name' => $_POST['name'][$n],
                    'dr_amount' => $_POST['debit_amount'][$n],
                    'cr_amount' => $_POST['credit_amount'][$n],
                    'ref_no' => $ref_no,
                    'jv_date' => $_POST['issue_date'],
                    'entry_date' => $_POST['issue_date'],//now();
                    'posted' => 0,
                    'trash' => 0,
                    'entry_by' => 1,//Auth::user()->id;
                    'slug' => substr(sha1(time()),30,40)
                ];
                $this->jv->save($data);
            }
            //session()->flash("success", "<strong>Success!</strong> New journal entry save.");
            return $this->response->redirect(site_url('/journal-voucher'));
        }else{
            //session()->flash("error", "<strong>Ooops!</strong> The value of DR must be same with CR. Try again.");
            return $this->response->redirect(site_url('/journal-voucher'));
        } 
    }

	public function saveAccount(){
        
        helper(['form']);
        $data = [];
        if($_POST){
         $rules = [
            'account_name'=>[
                'rules'=>'required',
                'label'=>'Account name',
                'errors'=>[
                    'required'=>'Enter a unique account name'
                ]
            ],
            'glcode'=>[
                'rules'=>'required',
                'label'=>'GL Code',
                'errors'=>[
                    'required'=>'Enter a GL code'
                ]
            ],
        ]; 
    }
        $data = [
            'account_name'=>$this->request->getVar('account_name'),
            'account_type'=>$this->request->getVar('account_type'),
            'bank'=>$this->request->getVar('bank'),
            'glcode'=>$this->request->getVar('gl_code'),
            'parent_account'=>$this->request->getVar('parent_account'),
            'type'=>$this->request->getVar('type'),
            'note'=>$this->request->getVar('note')
        ];
        $this->coa->save($data);
        return $this->response->redirect(site_url('/chart-of-accounts'));
    }

}
