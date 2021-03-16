<?php namespace App\Controllers;
use App\Models\ContributionTypeModel; 
use App\Models\SavingVariationsModel; 

class SavingVariationController extends BaseController
{

     public function __construct(){
        $this->session = session();
        $this->contributiontype = new ContributionTypeModel;
        $this->savingvariation = new SavingVariationsModel;
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
                'sv_staff_id'=>$this->request->getVar('staff_id'),
                'ct_type_id'=>$this->request->getVar('contribution_type'),
                'sv_month'=>$this->request->getVar('month'),
                'sv_year'=>$this->request->getVar('year'),
                'sv_amount'=>$this->request->getVar('amount')
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
    
}
