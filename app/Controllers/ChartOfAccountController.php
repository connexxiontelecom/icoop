<?php namespace App\Controllers;
use App\Models\CoaModel;

class ChartOfAccountController extends BaseController
{
    public function __construct(){
        $this->coa = new CoaModel();
        $this->session = session();
    }
	public function index()
	{
        $data['charts'] = $this->coa->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/coa/index',$data);
    }
    
	public function create(){
        $username = $this->session->user_username;
        $data = [];
        $this->authenticate_user($username, 'pages/coa/add-new-account',$data);
    }
    
    public function getParentAccount(){
        $data['accounts'] = $this->coa->where(['type'=> 0])->findAll(); //0=general; 1=detail
        
        return view('pages/coa/partials/_accounts', $data);
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
