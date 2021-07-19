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


    public function showProfitLoss(){
        //$data['accounts'] = $this->coa->where(['type'=> 0])->findAll(); //0=general; 1=detail
        $data = [];
        return view('pages/financial-report/profit-loss', $data);
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
				                            ->where('gl_transaction_date <', $from)
				                            ->where('glcode', $asset['glcode'])
				                            ->findAll();
		                $ob[0]['account_name'] = $asset['account_name'];
		                $ob[0]['acc_code'] = $asset['glcode'];
		                
		                
		                $pb =  $this->glmodel->selectSum('cr_amount', 'pbcr')
			                ->selectSum('dr_amount', 'pbdr')
			                ->where('gl_transaction_date >=', $from)
			                ->where('gl_transaction_date <=', $to)
			                ->where('glcode', $asset['glcode'])
			                ->findAll();
			          
		                
		                
		               $asset_array[$i]['opening'] = $ob[0] ;
			            $asset_array[$i]['period'] =$pb[0];
		               $i++;
			         endif;
	            endforeach;
								    
            
	          
            
//            $inception = $this->glmodel->getFirstTransaction();
//            $bfDrObj = $this->glmodel->getBfDr($this->request->getVar('from'), $this->request->getVar('to'));
//            $bfCrObj = $this->glmodel->getBfCr($this->request->getVar('from'), $this->request->getVar('to'));
//            $reports = $this->glmodel->getReport($this->request->getVar('from'), $this->request->getVar('to'));
//            $report_s = array();
//            /* $i = 0;
//            foreach($reports as $report){
//                   $report_s[$i] = $report + $this->glmodel->where('glcode', $report['glcode'])->first();
//                   $i++;
//
//            } */
//            return dd($reports);
//            $bfDr = 0;
//            $bfCr = 0;
//            foreach($bfDrObj as $dr){
//                $bfDr += $dr->dr_amount;
//            }
//            foreach($bfCrObj as $cr){
//                $bfCr += $cr->cr_amount;
//            }
//            $drSum = 0;
//            $crSum = 0;
//            foreach($reports as $re){
//                $drSum += $re->dr_amount;
//            }
//            foreach($reports as $port){
//                $crSum += $port->cr_amount;
//            }
//            $data = [
//                'bfDr'=>$bfDr,
//                'bfCr'=>$bfCr,
//                'reports'=>$reports,
//                'sumDebit'=>$drSum,
//                'sumCredit'=>$crSum
//            ];
	        $data['assets'] = $asset_array;
	        
//	        foreach ($asset_array as $ass):
//		        print_r($ass);
//	        echo '<br>';
//	        echo '<br>';
//
//		        endforeach;
          
	        
	        return view('pages/financial-report/trial-balance-report', $data);

        }
    }


    public function profitOrLoss(){
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
            $inception = $this->glmodel->getFirstTransaction();
        if(!empty($inception)){
            $bfDrObj = $this->glmodel->getBfDr($this->request->getVar('from'), $this->request->getVar('to'));
            $bfCrObj = $this->glmodel->getBfCr($this->request->getVar('from'), $this->request->getVar('to'));
            $reports = $this->glmodel->getReport($this->request->getVar('from'), $this->request->getVar('to'));
            $revenue = $this->glmodel->getRevenue($this->request->getVar('from'), $this->request->getVar('to'));
            $expenses = $this->glmodel->getExpenses($this->request->getVar('from'), $this->request->getVar('to'));
            $bfDr = 0;
            $bfCr = 0;
            foreach($bfDrObj as $dr){
                $bfDr += $dr->dr_amount;
            }
            foreach($bfCrObj as $cr){
                $bfCr += $cr->cr_amount;
            }
            $drSum = 0;
            $crSum = 0;
            foreach($reports as $re){
                $drSum += $re->dr_amount;
            }
            foreach($reports as $port){
                $crSum += $port->cr_amount;
            }
            $data = [
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'reports'=>$reports,
                'sumDebit'=>$drSum,
                'sumCredit'=>$crSum,
                'revenue'=>$revenue,
                'expense'=>$expenses

            ];
             return view('pages/financial-report/profit-loss-report', $data);
        }
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
                'to'=>[
                    'rules'=>'required',
                    'label'=>'To',
                    'errors'=>[
                        'required'=>'End date'
                    ]
                ],
            ];
            $inception = $this->glmodel->getFirstTransaction();
        if(!empty($inception)){
            $bfDrObj = $this->glmodel->getBfDr($this->request->getVar('from'), $this->request->getVar('to'));
            $bfCrObj = $this->glmodel->getBfCr($this->request->getVar('from'), $this->request->getVar('to'));
            $reports = $this->glmodel->getReport($this->request->getVar('from'), $this->request->getVar('to'));
            $revenue = $this->glmodel->getRevenue($this->request->getVar('from'), $this->request->getVar('to'));
            $expenses = $this->glmodel->getExpenses($this->request->getVar('from'), $this->request->getVar('to'));
            $bfDr = 0;
            $bfCr = 0;
            foreach($bfDrObj as $dr){
                $bfDr += $dr->dr_amount;
            }
            foreach($bfCrObj as $cr){
                $bfCr += $cr->cr_amount;
            }
            $drSum = 0;
            $crSum = 0;
            foreach($reports as $re){
                $drSum += $re->dr_amount;
            }
            foreach($reports as $port){
                $crSum += $port->cr_amount;
            }
            $data = [
                'bfDr'=>$bfDr,
                'bfCr'=>$bfCr,
                'reports'=>$reports,
                'sumDebit'=>$drSum,
                'sumCredit'=>$crSum,
                'revenue'=>$revenue,
                'expense'=>$expenses

            ];
             return view('pages/financial-report/balance-sheet-report', $data);
        }
    }
    }

}
