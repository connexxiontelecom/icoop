<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanSetupModel extends Model{
    protected $table = 'loan_setups';
    protected $primaryKey = 'loan_setup_id';
    protected $allowedFields = ['loan_description', 'age_qualification', 'psr', 'psr_value', 'min_credit_limit', 
        'max_credit_limit', 'max_repayment_periods', 'ls_interest_rate', 'interest_method',
        'commitment', 'commitment_value', 'loan_gl_account_no', 
        'loan_unearned_int_gl_account_no', 'loan_int_income_gl_account_no', 'loan_terms', 'status', 'payable',
        'created_date', 'interest_charge_type'];


      public function getLoanSetups(){
        $builder = $this->db->table('loan_setups');
        $builder->join('coas', 'coas.glcode = loan_setups.loan_gl_account_no');
        return $builder->get()->getResultObject();
    }
    
    public function getLoanSetup($loan_id){
        $builder = $this->db->table('loan_setups');
          $builder->where('loan_setups.loan_setup_id', $loan_id);
        $builder->join('coas', 'coas.glcode = loan_setups.loan_gl_account_no');
        return $builder->get()->getRowObject();
    }

}

?>
