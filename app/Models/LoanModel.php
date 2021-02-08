<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanModel extends Model{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $allowedFields = ['loan_app_id', 'staff_id', 'amount', 'interest_rate', 'loan_type', 'interest', 'disburse', 'created_at', 'scheduled', 'paid_back'];



    public function getScheduledPayment(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->where('loans.disburse = 0');
        $builder->where('loans.scheduled = 0');
        return $builder->get()->getResultObject();
    }

    public function getCooperatorSavings($id){
        $builder = $this->db->table('payment_details');
        /* $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id'); */
        $builder->where('payment_details.pd_staff_id = '.$id);
        $builder->selectSum('payment_details.pd_amount');
        return $builder->get()->getRowObject();
    }

    public function getPayables(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->where('loans.paid_back = 0');
        $builder->where('loans.disburse = 0');
        return $builder->get()->getResultObject();
    }
	
	public function get_interestable_loans($date){
		$builder = $this->db->table('loans');
		//$builder->join('loans', 'loans.loan_id = loan_repayments.lr_loan_id');
		$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
		//$builder->groupBy('payment_details.pd_ct_id');
		$builder->where('loans.disburse', 1);
		$builder->where('loans.paid_back', 0);
		$builder->where('loans.disburse_date <', $date);
		return $builder->get()->getResultObject();
	}

}

?>
