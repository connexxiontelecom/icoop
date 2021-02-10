<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanModel extends Model{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $allowedFields = ['loan_app_id', 'staff_id', 'schedule_master_id', 'amount', 'interest_rate', 'loan_type', 'interest', 'disburse', 'cart', 'created_at', 'scheduled', 'paid_back'];



    public function getScheduledPayment(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->where('loans.disburse = 0');
        $builder->where('loans.scheduled = 0');
        $builder->where('loans.cart = 0');
        return $builder->get()->getResultObject();
    }
    public function getLoanCart($id){
        $builder = $this->db->table('loans');
        //$builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('payment_carts', 'payment_carts.loan_id = loans.loan_id');
        $builder->where('loans.loan_id = '.$id);
        return $builder->get()->getRowObject();
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




    #Approved loans
    public function getApprovedLoans(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->where('loans.cart = 0');
        return $builder->get()->getResultObject();
    }
    #Items in cart
    public function getItemsInCart(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->join('banks', 'cooperators.cooperator_bank_id = banks.bank_id');
        $builder->where('loans.cart = 1');
        $builder->where('loans.scheduled = 0');
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
	
	public function get_loan_staff_id($staff_id){
		$builder = $this->db->table('loans');
		$builder->where('loans.staff_id', $staff_id);
		
		return $builder->get()->getResultObject();
	}
	
	public function get_loans_staff_id($staff_id, $loan_id){
		$builder = $this->db->table('loans');
		$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
		$builder->join('loan_applications', 'loan_applications.loan_app_id = loans.loan_app_id');
		$builder->join('loan_repayments', 'loan_repayments.lr_loan_id = loans.loan_id');
		$builder->where('loan_repayments.lr_loan_id', $loan_id);
		$builder->where('loans.staff_id', $staff_id);
		return $builder->get()->getResultObject();
  
	}
	
	public function get_loan_ledger_past_year($staff_id, $loan_id, $year){
		$builder = $this->db->table('loans');
		$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
		$builder->join('loan_repayments', 'loan_repayments.lr_loan_id = loans.loan_id');
		$builder->where('loan_setups.loan_setup_id', $loan_id);
		$builder->where('loans.staff_id', $staff_id);
		$builder->where('year(loan_repayments.lr_date) <', $year);
		
		//$builder = $this->db->query("select * from payment_details where pd_staff_id = '$staff_id', pd_ct_id = '$ct_id', date('Y', strtotime('pd_transaction_date')) = '$year'");
		return $builder->get()->getResultObject();
	}
	
	public function get_loan_ledger_present_year($staff_id, $loan_id, $year){
		$builder = $this->db->table('loans');
		$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
		$builder->join('loan_repayments', 'loan_repayments.lr_loan_id = loans.loan_id');
		$builder->where('loan_setups.loan_setup_id', $loan_id);
		$builder->where('loans.staff_id', $staff_id);
		$builder->where('year(loan_repayments.lr_date)', $year);
		
		//$builder = $this->db->query("select * from payment_details where pd_staff_id = '$staff_id', pd_ct_id = '$ct_id', date('Y', strtotime('pd_transaction_date')) = '$year'");
		return $builder->get()->getResultArray();
	}
	
	public function get_active_loans_staff_id($staff_id, $lt_id){
		$builder = $this->db->table('loans');
		$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
		$builder->join('loan_applications', 'loan_applications.loan_app_id = loans.loan_app_id');
		$builder->where('loans.disburse', 1);
		$builder->where('loans.paid_back', 0);
		$builder->where('loan_setups.loan_setup_id', $lt_id);
		$builder->where('loans.staff_id', $staff_id);
		return $builder->get()->getRowObject();
		
	}
	
	
	
	

}

?>
