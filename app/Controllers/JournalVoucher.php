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
       // $data['entries'] = $this->jv->where('posted',0)->where('trash',0)->findAll();
		//$data['entries'] = $this->jv->get_jv();
		$jvs = $this->jv->get_jv();
		
		$total_credit = 0;
		$total_debit = 0;
		$i = 0;
		$entries = array();
		foreach ($jvs as $jv):
			$ref_no = $jv['ref_no'];
				$jv_ds = $this->jv->where('ref_no', $ref_no)->findAll();
				
				foreach ($jv_ds as $jv_d):
					$total_credit = $total_credit + $jv_d['cr_amount'];
					$total_debit = $total_debit + $jv_d['dr_amount'];
				
					endforeach;
					
					$jv['total_credit'] = $total_credit;
					$jv['total_debit'] = $total_debit;
					
			$entries[$i] = $jv;
			$i++;
			endforeach;
			
        $username = $this->session->user_username;
		$data['entries'] = $entries;
        //print_r($entries);
       $this->authenticate_user($username, 'pages/jv/index',$data);
    }
    
	public function create(){
        $username = $this->session->user_username;
        $jv_entry = "JV".rand(10,100);
        while($this->jv->find(['ref_no' => $jv_entry])):
	        $jv_entry = "JV".rand(10,100);
	        
	        endwhile;
	     $data['jv_entry'] = $jv_entry;
        $data['accounts'] = $this->coa->where('type', 1)->findAll();
        $this->authenticate_user($username, 'pages/jv/create',$data);
    }

    public function view($id){
        $username = $this->session->user_username;
        $data['entries'] = $this->jv->where(['ref_no' => $id, 'posted' => 0, 'trash' => 0])->findAll();
        $this->authenticate_user($username, 'pages/jv/view',$data);
    }
    public function post(){
    	
    	$ref_no = $_POST['ref_no'];
    	
       
        $journals = $this->jv->where(['ref_no'=> $ref_no, 'posted' => 0, 'trash'=> 0])->findAll();
        
        if(!empty($journals)):
        
            foreach ($journals as $journal):
	        $account = $this->coa->where('glcode', $journal['glcode'])->first();
               
	                $bankGl = array(
		                'glcode' => $journal['glcode'],
		                'posted_by' => $this->session->user_username,
		                'narration' => $journal['narration'],
		                'dr_amount' => $journal['dr_amount'],
		                'cr_amount' => $journal['cr_amount'],
		                'ref_no' => $journal['ref_no'] ?? '',
		                'bank' => $account['bank'],
		                'ob' => 0,
		                'posted' => 1,
		                'created_at' => $journal['jv_date'],
	                );
	               $i =  $this->gl->save($bankGl);

	                $jv_array = array(
	                	'journal_id' => $journal['journal_id'],
		                'posted' => 1,
		                'posted_date' => date('Y-m-d H:i:s')
	                );
	                
	               $j = $this->jv->save($jv_array);
              
	        endforeach;
	        
	    endif;
	        
	        if($i && $j):
		        $data = array(
			        'msg' => 'Jv Posted',
			        'type' => 'success',
			        'location' => base_url('journal-voucher')
		
		        );
		
		        echo view('pages/sweet-alert', $data);
	
	        else:
		        $data = array(
			        'msg' => 'An error occurred',
			        'type' => 'error',
			        'location' => base_url('journal-voucher')
		
		        );
		
		        echo view('pages/sweet-alert', $data);
			        
			        endif;
       
    }
    public function decline(){
	
	    $ref_no = $_POST['ref_no'];
	
	
	    $journals = $this->jv->where(['ref_no'=> $ref_no, 'posted' => 0, 'trash'=> 0])->findAll();
	
	    if(!empty($journals)):
		
		    foreach ($journals as $journal):
			
			
			    $jv_array = array(
				    'journal_id' => $journal['journal_id'],
				    'trash' => 1,
				    'trash_date' => date('Y-m-d H:i:s'),
				    'trash_by' => $this->session->user_username
			    );
			
			    $j = $this->jv->save($jv_array);
		
		    endforeach;
	
	    endif;
	
	    if($j):
		    $data = array(
			    'msg' => 'JV Disapproved',
			    'type' => 'success',
			    'location' => base_url('journal-voucher')
		
		    );
		
		    echo view('pages/sweet-alert', $data);
	
	    else:
		    $data = array(
			    'msg' => 'An error occurred',
			    'type' => 'error',
			    'location' => base_url('journal-voucher')
		
		    );
		
		    echo view('pages/sweet-alert', $data);
	
	    endif;
     
     
    }
    
    public function store(){
	    $this->validator->setRules( [
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
	    ]);
	
	    if ($this->validator->withRequest($this->request)->run()):
    	
      
        $cr_total = 0;
        $dr_total = 0;
        //return dd($this->request->getPost('credit_amount'));
        for($i = 0; $i<count($this->request->getPost('debit_amount')); $i++):
                $dr_total += str_replace(',', '',$_POST['debit_amount'][$i]);
        endfor;
		
		    for($i = 0; $i<count($this->request->getPost('credit_amount')); $i++):
			    $cr_total +=  str_replace(',', '',$_POST['credit_amount'][$i]);
		    endfor;
		
		
		
		    $ref_no = substr(sha1(time()), 32,40);
        if($cr_total == $dr_total){
         
	
	        
	        
            
            for($n = 0; $n<count($this->request->getVar('debit_amount')); $n++){
	            if($_POST['debit_amount'][$n] > 0):
	                $data = array(
		                    'glcode' => $_POST['debit_account'][$n],
		                    'narration' => $_POST['debit_narration'][$n],
		                    'name' => '',
		                    'dr_amount' => str_replace(',', '',$_POST['debit_amount'][$n]),
		                    'cr_amount' => 0,
		                    'ref_no' => $_POST['entry_no'],
		                    'jv_date' => $_POST['issue_date'],
		                    'entry_date' => date('Y-m-d'),//now();
		                    'posted' => 0,
		                    'trash' => 0,
		                    'entry_by' => $this->session->user_username
	                   
		             );
                $i = $this->jv->save($data);
                endif;
            }
	        for($n = 0; $n<count($this->request->getVar('credit_amount')); $n++){
		
		        if($_POST['credit_amount'][$n] > 0):
			        $data = array(
				        'glcode' => $_POST['credit_account'][$n],
				        'narration' => $_POST['credit_narration'][$n],
				        'name' => '',
				        'dr_amount' => 0,
				        'cr_amount' => str_replace(',', '',$_POST['credit_amount'][$n]),
				        'ref_no' => $_POST['entry_no'],
				        'jv_date' => $_POST['issue_date'],
				        'entry_date' => date('Y-m-d'),//now();
				        'posted' => 0,
				        'trash' => 0,
				        'entry_by' => $this->session->user_username
			
			        );
			        $k = $this->jv->save($data);
		        endif;
	        }
	        
	        if($i && $k):
		
		        $data = array(
			        'msg' => 'Action successful',
			        'type' => 'success',
			        'location' => base_url('/new-journal-voucher')
		
		        );
		
		        echo view('pages/sweet-alert', $data);
		        
		        else:
			        $data = array(
				        'msg' => 'An error occurred',
				        'type' => 'error',
				        'location' => base_url('/new-journal-voucher')
			
			        );
			
			        echo view('pages/sweet-alert', $data);
			        endif;
            //session()->flash("success", "<strong>Success!</strong> New journal entry save.");
           // return $this->response->redirect(site_url('/journal-voucher'));
        }else{
            //session()->flash("error", "<strong>Ooops!</strong> The value of DR must be same with CR. Try again.");
	
	        $data = array(
		        'msg' => 'Total DR must equal Total CR',
		        'type' => 'error',
		        'location' => base_url('/journal-voucher')
	
	        );
	
	        echo view('pages/sweet-alert', $data);
	       // return $this->response->redirect(site_url('/journal-voucher'));
        }
        
        else:
	
	        $arr = $this->validator->getErrors();
	
	        $data = array(
		        'msg' => implode(", ", $arr),
		        'type' => 'error',
		        'location' => base_url('/journal-voucher')
	
	        );
	
	        echo view('pages/sweet-alert', $data);
	        endif;
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
