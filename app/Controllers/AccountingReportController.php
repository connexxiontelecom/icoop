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
            //$current = Carbon::now();
            $inception = $this->glmodel->getFirstTransaction();
            return dd($inception);
            //DB::table(Auth::user()->tenant_id.'_gl')->orderBy('id', 'ASC')->first();
          /*   if(!empty($inception)){
                $bfDr = 
                $bfCr = DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('cr_amount');
                $reports = DB::table(Auth::user()->tenant_id.'_gl as g')
                    ->join(Auth::user()->tenant_id.'_coa as c', 'c.glcode', '=', 'g.glcode')
                    ->select(DB::raw('sum(g.dr_amount) AS sumDebit'),DB::raw('sum(g.cr_amount) AS sumCredit'),
                        'c.account_name', 'g.glcode', 'c.glcode', 'c.account_type', 'c.type')
                    //->where('c.account_type', 1)
                    ->where('c.type', 'Detail')
                    ->whereBetween('g.created_at', [$request->from, $request->to])
                    ->orderBy('c.account_type', 'ASC')
                    ->groupBy('c.account_name')
                    ->get();
                return view('backend.reports.trial-balance', [
                    'reports'=>$reports,
                    'bfDr'=>$bfDr,
                    'bfCr'=>$bfCr,
                    'from'=>$request->from,
                    'to'=>$request->to
                ]);
            }else{
                session()->flash("error", "<strong>Ooops!</strong> No record found.");
                return back();
            } */

        }
    }

}
