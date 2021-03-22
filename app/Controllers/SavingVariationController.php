<?php namespace App\Controllers;
use App\Models\ContributionTypeModel; 
use App\Models\SavingVariationsModel; 
use App\Models\PaymentDetailsModel; 
use App\Models\Cooperators; 

class SavingVariationController extends BaseController
{

     public function __construct(){
        $this->session = session(); 
        $this->contributiontype = new ContributionTypeModel;
        $this->savingvariation = new SavingVariationsModel;
        $this->pd = new PaymentDetailsModel();
        $this->coop = new Cooperators();
        
    }

    
    public function showSavingVariationForm(){
        $data = [
            'contribution_types'=>$this->contributiontype->findAll(),
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/saving-variation/new', $data);
    }

    public function postSavingVariationForm(){
        helper(['form']);
        $data = [];
        if($_POST){
            $data = [
                'sv_staff_id'=>current(explode(",", $this->request->getVar('staff_id'))),
                'ct_type_id'=>$this->request->getVar('contribution_type'),
                'sv_month'=>$this->request->getVar('month'),
                'sv_year'=>$this->request->getVar('year'),
                'sv_amount'=>$this->request->getVar('amount'),
                'sv_status'=>0
            ];
            $this->savingvariation->save($data);
            $alert = array(
                    'msg' => 'Success! Saving variations saved.',
                    'type' => 'success',
                    'location' => site_url('/saving-variations/new')
                );
            return view('pages/sweet-alert', $alert);
        }
    }


    public function showUnverifiedSavingVariations(){
        $data = [
            'unverified_savings'=>$this->savingvariation->getUnverifiedSavingVariations()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/saving-variation/unverified-savings', $data);
    }


    public function getPaymentDetails($id){
        $data = [
            'payments'=>$this->savingvariation->getPaymentDetailsByContributionType($id)
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/saving-variation/_payment-details', $data);
    }

    public function getStaffContributionType(){
         $data = [
            'contribution_types'=>$this->pd->getStaffPaymentDetails($this->request->getVar('staff'))
         ];
         $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/saving-variation/_contribution-types', $data);

    }


    public function verifySavingVariation(){
        helper(['form']);
        $data = [];
        if($_POST){

            //return dd($_POST);
            $data = [
                'saving_variation_id'=>$this->request->getVar('saving_variation'),
                'sv_verified_by'=>$this->session->user_first_name." ".$this->session->user_last_name,
                'sv_date_verified'=>date('Y-m-d H:i:s'),
                'sv_status'=>1,
            ];
            $this->savingvariation->save($data);
                $alert = array(
                        'msg' => 'Success! Verification done.',
                        'type' => 'success',
                        'location' => site_url('/saving-variations/unverified')
                    );
                    return view('pages/sweet-alert', $alert);
        }
    }

    public function showVerifiedSavingVariations(){
        $data = [
            'verified_savings'=>$this->savingvariation->getVerifiedSavingVariations()
        ];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/saving-variation/verified-savings', $data);
    }

    public function approveSavingVariation(){
        helper(['form']);
        $data = [];
        
        if($_POST){
            $data = [
                'saving_variation_id'=>$this->request->getVar('saving_variation'),
                'sv_approved_by'=>$this->session->user_first_name." ".$this->session->user_last_name,
                'sv_date_approved'=>date('Y-m-d H:i:s'),
                'sv_status'=>2,
            ];
            $this->savingvariation->save($data);
            #Update cooperator's saving
            $coop = $this->coop->where('cooperator_staff_id', $this->request->getVar('staff'))->first();
            $savings = $coop['cooperator_savings'] + $this->request->getVar('sv_amount');
            $saving_data = [
                'cooperator_id' => $coop['cooperator_id'],
                'cooperator_savings'=> $savings
            ];
            $this->coop->save($saving_data);
                $alert = array(
                        'msg' => 'Success! Approval done.',
                        'type' => 'success',
                        'location' => site_url('/saving-variations/verified')
                    );
                    return view('pages/sweet-alert', $alert);
        }
    }
    
}
