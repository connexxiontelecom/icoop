<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanSetupModel extends Model{
    protected $table = 'loan_setups';
    protected $primaryKey = 'loan_setup_id';
    protected $allowedFields = ['loan_description', 'qualification_age', 'psr', 'psr_value', 'min_credit_limit', 
        'max_credit_limit', 'max_repayment_periods', 'interest_rate', 'interest_method',
        'commitment', 'commitment_value', 'loan_gl_account_number', 
        'loan_unearned_int_gl_account_no', 'loan_int_income_gl_account_no', 'loan_terms',
        'created_at'];

}

?>