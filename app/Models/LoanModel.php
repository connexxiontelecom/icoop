<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanModel extends Model{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $allowedFields = ['loan_app_id', 'staff_id', 'amount', 'interest_rate', 'loan_type', 'interest', 'disburse', 'created_at'];



    public function getScheduledPayment(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->where('loans.disburse = 0');
        return $builder->get()->getResultObject();
    }

}

?>