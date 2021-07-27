<?php namespace App\Controllers;
use App\Models\CoaModel;
use App\Models\GlModel;

class AccountingReportController extends BaseController
{
    public function __construct(){
        $this->coa = new CoaModel();
        $this->glmodel = new GlModel();
        $this->session = session();
    }
	
	
	public function showTrialBalanceForm(){
		//$data['accounts'] = $this->coa->where(['type'=> 0])->findAll(); //0=general; 1=detail
		$data = [];
		return view('pages/financial-report/trial-balance', $data);
	}
	
	
	public function trialBalance(){
		helper(['form']);
		$data = [];
		
		if($_POST){
			$rules = [
				'from'=>[
					'rules'=>'required',
					'label'=>'From',
					'errors'=>[
						'required'=>'Start date'
					]
				],
				'to'=>[
					'rules'=>'required',
					'label'=>'To',
					'errors'=>[
						'required'=>'End date'
					]
				],
			];
			
			
			
			$to = $_POST['to'];
			$from = $_POST['from'];
			
			$y_to =  date('Y', strtotime($to));
			
			$y_from =  date('Y', strtotime($from));
			
			
			if($y_to == $y_from):
				
				$assets = $this->coa->where('account_type', 1)
					->where('type', 1)
					->findAll();
				
				
				$asset_array = array();
				$i = 0;
				foreach ($assets as $asset):
					
					$check_activity = $this->glmodel->where('glcode', $asset['glcode'])->first();
					
					if(!empty($check_activity)):
						$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
							->selectSum('dr_amount', 'obdr')
							->where('year(gl_transaction_date)', $y_from)
							
							->where('gl_transaction_date <', $from)
							->where('glcode', $asset['glcode'])
							
							->findAll();
						$ob[0]['account_name'] = $asset['account_name'];
						$ob[0]['acc_code'] = $asset['glcode'];
						
						
						$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
							->selectSum('dr_amount', 'pbdr')
							->where('year(gl_transaction_date)', $y_from)
							
							->where('gl_transaction_date >=', $from)
							->where('gl_transaction_date <=', $to)
							
							->where('glcode', $asset['glcode'])
							->findAll();
						
						
						
						$asset_array[$i]['opening'] = $ob[0] ;
						$asset_array[$i]['period'] =$pb[0];
						$i++;
					endif;
				endforeach;
				
				$liabilities = $this->coa->where('account_type', 2)
					->where('type', 1)
					->findAll();
				
				
				$liability_array = array();
				$i = 0;
				foreach ($liabilities as $liability):
					
					$check_activity = $this->glmodel->where('glcode', $liability['glcode'])->first();
					
					if(!empty($check_activity)):
						$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
							->selectSum('dr_amount', 'obdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date <', $from)
							->where('glcode', $liability['glcode'])
							->findAll();
						$ob[0]['account_name'] = $liability['account_name'];
						$ob[0]['acc_code'] = $liability['glcode'];
						
						
						$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
							->selectSum('dr_amount', 'pbdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date >=', $from)
							->where('gl_transaction_date <=', $to)
							->where('glcode', $liability['glcode'])
							->findAll();
						
						
						
						$liability_array[$i]['opening'] = $ob[0] ;
						$liability_array[$i]['period'] =$pb[0];
						$i++;
					endif;
				endforeach;
				
				
				
				$equities = $this->coa->where('account_type', 3)
					->where('type', 1)
					->findAll();
				
				
				$equity_array = array();
				$i = 0;
				foreach ($equities as $equity):
					
					$check_activity = $this->glmodel->where('glcode', $equity['glcode'])->first();
					
					if(!empty($check_activity)):
						$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
							->selectSum('dr_amount', 'obdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date <', $from)
							->where('glcode', $equity['glcode'])
							->findAll();
						$ob[0]['account_name'] = $equity['account_name'];
						$ob[0]['acc_code'] = $equity['glcode'];
						
						
						$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
							->selectSum('dr_amount', 'pbdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date >=', $from)
							->where('gl_transaction_date <=', $to)
							->where('glcode', $equity['glcode'])
							->findAll();
						
						$equity_array[$i]['opening'] = $ob[0] ;
						$equity_array[$i]['period'] =$pb[0];
						$i++;
					endif;
				endforeach;
				
				$revenues = $this->coa->where('account_type', 4)
					->where('type', 1)
					->findAll();
				
				
				$revenue_array = array();
				$i = 0;
				$total_revenue_dr = 0;
				$total_revenue_cr = 0;
				
				foreach ($revenues as $revenue):
					
					$check_activity = $this->glmodel->where('glcode', $revenue['glcode'])->first();
					
					if(!empty($check_activity)):
						
						$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
							->selectSum('dr_amount', 'obdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date <', $from)
							->where('glcode', $revenue['glcode'])
							->findAll();
						
						$total_revenue_cr = $ob[0]['obcr'] + $total_revenue_cr;
						$total_revenue_dr = $ob[0]['obdr'] + $total_revenue_dr;
						
						
						
						
						$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
							->selectSum('dr_amount', 'pbdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date >=', $from)
							->where('gl_transaction_date <=', $to)
							->where('glcode', $revenue['glcode'])
							->findAll();
						
						$pb[0]['account_name'] = $revenue['account_name'];
						$pb[0]['acc_code'] = $revenue['glcode'];
						$revenue_array[$i]['period'] =$pb[0];
						$i++;
					endif;
				endforeach;
				
				
				$expenses = $this->coa->where('account_type', 5)
					->where('type', 1)
					->findAll();
				
				
				$expense_array = array();
				$i = 0;
				$total_expense_dr = 0;
				$total_expense_cr = 0;
				foreach ($expenses as $expense):
					
					$check_activity = $this->glmodel->where('glcode', $expense['glcode'])->first();
					
					if(!empty($check_activity)):
						$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
							->selectSum('dr_amount', 'obdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date <', $from)
							->where('glcode', $revenue['glcode'])
							->findAll();
						
						$total_expense_cr = $ob[0]['obcr'] + $total_expense_cr;
						$total_expense_dr = $ob[0]['obdr'] + $total_expense_dr;
						
						
						$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
							->selectSum('dr_amount', 'pbdr')
							->where('year(gl_transaction_date)', $y_from)
							->where('gl_transaction_date >=', $from)
							->where('gl_transaction_date <=', $to)
							->where('glcode', $expense['glcode'])
							->findAll();
						
						$pb[0]['account_name'] = $expense['account_name'];
						$pb[0]['acc_code'] = $expense['glcode'];
						$expense_array[$i]['period'] =$pb[0];
						$i++;
					endif;
				endforeach;
				
				$data['total_expense_cr'] = $total_expense_cr;
				$data['total_expense_dr'] = $total_expense_dr;
				$data['total_revenue_cr'] = $total_revenue_cr;
				$data['total_revenue_dr'] = $total_revenue_dr;
				$data['from'] = $from;
				$data['to'] = $to;
				$data['expenses'] = $expense_array;
				$data['revenues'] = $revenue_array;
				$data['assets'] = $asset_array;
				$data['liabilities'] = $liability_array;
				$data['equities'] = $equity_array;
				
				return view('pages/financial-report/trial-balance-report', $data);
			
			else:
				
				$data = array(
					'msg' => 'Select Date Within Same Year',
					'type' => 'error',
					'location' => site_url('/trial-balance')
				
				);
				
				return view('pages/sweet-alert', $data);
			
			endif;
		}
	}
	
	public function showBalanceSheet(){
		$data = [];
		return view('pages/financial-report/balance-sheet', $data);
	}
	
	
	public function balanceSheet(){
		helper(['form']);
		$data = [];
		
		
		if($_POST){
			$rules = [
				'from'=>[
					'rules'=>'required',
					'label'=>'From',
					'errors'=>[
						'required'=>'Start date'
					]
				],
			
			];
			
			
			
			$from = $_POST['from'];
			
			
			
			$assets = $this->coa->where('account_type', 1)
				->where('type', 1)
				->findAll();
			
			
			$asset_array = array();
			$i = 0;
			foreach ($assets as $asset):
				
				$check_activity = $this->glmodel->where('glcode', $asset['glcode'])->first();
				
				if(!empty($check_activity)):
					$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						->selectSum('dr_amount', 'obdr')
						
						->where('gl_transaction_date <=', $from)
						->where('glcode', $asset['glcode'])
						
						->findAll();
					$ob[0]['account_name'] = $asset['account_name'];
					$ob[0]['acc_code'] = $asset['glcode'];
					
					$asset_array[$i]['opening'] = $ob[0] ;
					
					$i++;
				endif;
			endforeach;
			
			$liabilities = $this->coa->where('account_type', 2)
				->where('type', 1)
				->findAll();
			
			
			$liability_array = array();
			$i = 0;
			foreach ($liabilities as $liability):
				
				$check_activity = $this->glmodel->where('glcode', $liability['glcode'])->first();
				
				if(!empty($check_activity)):
					$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						->selectSum('dr_amount', 'obdr')
						->where('gl_transaction_date <=', $from)
						->where('glcode', $liability['glcode'])
						->findAll();
					$ob[0]['account_name'] = $liability['account_name'];
					$ob[0]['acc_code'] = $liability['glcode'];
					$liability_array[$i]['opening'] = $ob[0] ;
					
					$i++;
				endif;
			endforeach;
			
			
			
			$equities = $this->coa->where('account_type', 3)
				->where('type', 1)
				->findAll();
			
			
			$equity_array = array();
			$i = 0;
			foreach ($equities as $equity):
				
				$check_activity = $this->glmodel->where('glcode', $equity['glcode'])->first();
				
				if(!empty($check_activity)):
					$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						->selectSum('dr_amount', 'obdr')
						->where('gl_transaction_date <=', $from)
						->where('glcode', $equity['glcode'])
						->findAll();
					$ob[0]['account_name'] = $equity['account_name'];
					$ob[0]['acc_code'] = $equity['glcode'];
					$equity_array[$i]['opening'] = $ob[0] ;
					
					$i++;
				endif;
			endforeach;
			
			$revenues = $this->coa->where('account_type', 4)
				->where('type', 1)
				->findAll();
			
			
			$revenue_array = array();
			$i = 0;
			$total_revenue_dr = 0;
			$total_revenue_cr = 0;
			
			foreach ($revenues as $revenue):
				
				$check_activity = $this->glmodel->where('glcode', $revenue['glcode'])->first();
				
				if(!empty($check_activity)):
					
					$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						->selectSum('dr_amount', 'obdr')
						->where('gl_transaction_date <=', $from)
						->where('glcode', $revenue['glcode'])
						->findAll();
					
					$total_revenue_cr = $ob[0]['obcr'] + $total_revenue_cr;
					$total_revenue_dr = $ob[0]['obdr'] + $total_revenue_dr;
					
					
					
					
					$i++;
				endif;
			endforeach;
			
			
			$expenses = $this->coa->where('account_type', 5)
				->where('type', 1)
				->findAll();
			
			
			$expense_array = array();
			$i = 0;
			$total_expense_dr = 0;
			$total_expense_cr = 0;
			foreach ($expenses as $expense):
				
				$check_activity = $this->glmodel->where('glcode', $expense['glcode'])->first();
				
				if(!empty($check_activity)):
					$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						->selectSum('dr_amount', 'obdr')
						->where('gl_transaction_date <', $from)
						->where('glcode', $revenue['glcode'])
						->findAll();
					
					$total_expense_cr = $ob[0]['obcr'] + $total_expense_cr;
					$total_expense_dr = $ob[0]['obdr'] + $total_expense_dr;
					
					
					
					$i++;
				endif;
			endforeach;
			
			$data['total_expense_cr'] = $total_expense_cr;
			$data['total_expense_dr'] = $total_expense_dr;
			$data['total_revenue_cr'] = $total_revenue_cr;
			$data['total_revenue_dr'] = $total_revenue_dr;
			$data['from'] = $from;
			
			$data['assets'] = $asset_array;
			$data['liabilities'] = $liability_array;
			$data['equities'] = $equity_array;
			
			return view('pages/financial-report/balance-sheet-report', $data);
			
			
		}
		
		
		
		
		
		
	}
	
	

	
    public function showProfitLoss(){
		//$data['accounts'] = $this->coa->where(['type'=> 0])->findAll(); //0=general; 1=detail
		$data = [];
		return view('pages/financial-report/profit-loss', $data);
	}

    public function profitOrLoss(){
	   
	    if($_POST){
		    $rules = [
			    'from'=>[
				    'rules'=>'required',
				    'label'=>'From',
				    'errors'=>[
					    'required'=>'Start date'
				    ]
			    ],
			    'to'=>[
				    'rules'=>'required',
				    'label'=>'To',
				    'errors'=>[
					    'required'=>'End date'
				    ]
			    ],
		    ];
		
		
		
		    $to = $_POST['to'];
		    $from = $_POST['from'];
		
		    $y_to =  date('Y', strtotime($to));
		
		    $y_from =  date('Y', strtotime($from));
		
		
		    if($y_to == $y_from):
					
			    $revenues = $this->coa->where('account_type', 4)
				    ->where('type', 1)
				    ->findAll();
			
			
			    $revenue_array = array();
			    $i = 0;
			    $total_revenue_dr = 0;
			    $total_revenue_cr = 0;
			
			    foreach ($revenues as $revenue):
				
				    $check_activity = $this->glmodel->where('glcode', $revenue['glcode'])->first();
				
				    if(!empty($check_activity)):
					
					    $ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						    ->selectSum('dr_amount', 'obdr')
						    ->where('year(gl_transaction_date)', $y_from)
						    ->where('gl_transaction_date <', $from)
						    ->where('glcode', $revenue['glcode'])
						    ->findAll();
					
					    $total_revenue_cr = $ob[0]['obcr'] + $total_revenue_cr;
					    $total_revenue_dr = $ob[0]['obdr'] + $total_revenue_dr;
					
					
					
					
					    $pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
						    ->selectSum('dr_amount', 'pbdr')
						    ->where('year(gl_transaction_date)', $y_from)
						    ->where('gl_transaction_date >=', $from)
						    ->where('gl_transaction_date <=', $to)
						    ->where('glcode', $revenue['glcode'])
						    ->findAll();
					
					    $pb[0]['account_name'] = $revenue['account_name'];
					    $pb[0]['acc_code'] = $revenue['glcode'];
					    $revenue_array[$i]['period'] =$pb[0];
					    $i++;
				    endif;
			    endforeach;
			
			
			    $expenses = $this->coa->where('account_type', 5)
				    ->where('type', 1)
				    ->findAll();
			
			
			    $expense_array = array();
			    $i = 0;
			    $total_expense_dr = 0;
			    $total_expense_cr = 0;
			    foreach ($expenses as $expense):
				
				    $check_activity = $this->glmodel->where('glcode', $expense['glcode'])->first();
				
				    if(!empty($check_activity)):
					    $ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						    ->selectSum('dr_amount', 'obdr')
						    ->where('year(gl_transaction_date)', $y_from)
						    ->where('gl_transaction_date <', $from)
						    ->where('glcode', $revenue['glcode'])
						    ->findAll();
					
					    $total_expense_cr = $ob[0]['obcr'] + $total_expense_cr;
					    $total_expense_dr = $ob[0]['obdr'] + $total_expense_dr;
					
					
					    $pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
						    ->selectSum('dr_amount', 'pbdr')
						    ->where('year(gl_transaction_date)', $y_from)
						    ->where('gl_transaction_date >=', $from)
						    ->where('gl_transaction_date <=', $to)
						    ->where('glcode', $expense['glcode'])
						    ->findAll();
					
					    $pb[0]['account_name'] = $expense['account_name'];
					    $pb[0]['acc_code'] = $expense['glcode'];
					    $expense_array[$i]['period'] =$pb[0];
					    $i++;
				    endif;
			    endforeach;
			
			    $data['total_expense_cr'] = $total_expense_cr;
			    $data['total_expense_dr'] = $total_expense_dr;
			    $data['total_revenue_cr'] = $total_revenue_cr;
			    $data['total_revenue_dr'] = $total_revenue_dr;
			    $data['from'] = $from;
			    $data['to'] = $to;
			    $data['expenses'] = $expense_array;
			    $data['revenues'] = $revenue_array;
//			    $data['assets'] = $asset_array;
//			    $data['liabilities'] = $liability_array;
//			    $data['equities'] = $equity_array;
			
			    return view('pages/financial-report/profit-loss-report', $data);
		
		    else:
			
			    $data = array(
				    'msg' => 'Select Date Within Same Year',
				    'type' => 'error',
				    'location' => site_url('/profit-loss')
			
			    );
			
			    return view('pages/sweet-alert', $data);
		
		    endif;
	    }
    }
	
	
	public function glextract(){
		$method = strtolower($this->request->getMethod());
		
		if($method == 'post'):
			
			$this->validator->setRules( [
				'from'=>[
					'rules'=>'required',
					'label'=>'From',
					'errors'=>[
						'required'=>'Start date'
					]
				],
				'to'=>[
					'rules'=>'required',
					'label'=>'To',
					'errors'=>[
						'required'=>'End date'
					]
				],
				
				'account'=>[
					'rules'=>'required',
					'label'=>'Account',
					'errors'=>[
						'required'=>'Select an Account'
					]
				],
			]);
			
			if ($this->validator->withRequest($this->request)->run()):
			
			
			
				$to = $_POST['to'];
				$from = $_POST['from'];
				$account = $_POST['account'];
				
				$y_to =  date('Y', strtotime($to));
				
				$y_from =  date('Y', strtotime($from));
				
				
				if($y_to == $y_from):
					
					$account_details = $this->coa->where('glcode', $account)->first();
					
					
					$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
						->selectSum('dr_amount', 'obdr')
						->where('year(gl_transaction_date)', $y_from)
						->where('gl_transaction_date <', $from)
						->where('glcode', $account)
						->findAll();
					
						
					$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
						->selectSum('dr_amount', 'pbdr')
						->where('year(gl_transaction_date)', $y_from)
						->where('gl_transaction_date >=', $from)
						->where('gl_transaction_date <=', $to)
						->where('glcode', $account)
						->findAll();
					
					$pb_details = $this->glmodel->where('year(gl_transaction_date)', $y_from)
						->where('gl_transaction_date >=', $from)
						->where('gl_transaction_date <=', $to)
						->where('glcode', $account)
						->findAll();
					
					$data['account_details'] = $account_details;
					$data['ob'] = $ob[0];
					$data['pb'] = $pb[0];
					$data['pb_details'] = $pb_details;
					$data['from'] = $from;
					$data['to'] = $to;
					$data['accounts'] = $this->coa->where('type', 1)->findAll();
					$username = $this->session->user_username;
					$this->authenticate_user($username, 'pages/financial-report/glextract-report', $data);
		
					//return view('pages/financial-report/glextract-report', $data);
				else:
					$arr = $this->validator->getErrors();
					session()->setFlashData("errors",$arr);
					$url = site_url('glextract');
					return $this->response->redirect($url);
				endif;
			
			else:
				
				$data = array(
					'msg' => 'Select Date Within Same Year',
					'type' => 'error',
					'location' => site_url('/profit-loss')
				
				);
				
				return view('pages/sweet-alert', $data);
			
			endif;
		
		else:
			
		
			$data['accounts'] = $this->coa->where('type', 1)->findAll();
			$username = $this->session->user_username;
			$this->authenticate_user($username, 'pages/financial-report/glextract', $data);
		endif;
		
		
	}
	
	public function glextract_details(){
		$to = $_POST['to'];
		$from = $_POST['from'];
		$account = $_POST['account'];
		
		$y_to =  date('Y', strtotime($to));
		
		$y_from =  date('Y', strtotime($from));
		
		
	
			
			$account_details = $this->coa->where('glcode', $account)->first();
			
			
			$ob = $this->glmodel->selectSum('cr_amount', 'obcr')
				->selectSum('dr_amount', 'obdr')
				->where('year(gl_transaction_date)', $y_from)
				->where('gl_transaction_date <', $from)
				->where('glcode', $account)
				->findAll();
			
			
			$pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
				->selectSum('dr_amount', 'pbdr')
				->where('year(gl_transaction_date)', $y_from)
				->where('gl_transaction_date >=', $from)
				->where('gl_transaction_date <=', $to)
				->where('glcode', $account)
				->findAll();
			
			$pb_details = $this->glmodel->where('year(gl_transaction_date)', $y_from)
				->where('gl_transaction_date >=', $from)
				->where('gl_transaction_date <=', $to)
				->where('glcode', $account)
				->findAll();
			
			$data['account_details'] = $account_details;
			$data['ob'] = $ob[0];
			$data['pb'] = $pb[0];
			$data['pb_details'] = $pb_details;
			$data['from'] = $from;
			$data['to'] = $to;
			$data['accounts'] = $this->coa->where('type', 1)->findAll();
			$username = $this->session->user_username;
			$this->authenticate_user($username, 'pages/financial-report/glextract-report-details', $data);
	}

    
  
 

}
