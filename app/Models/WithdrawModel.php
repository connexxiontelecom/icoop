<?php


namespace App\Models;


class WithdrawModel extends \CodeIgniter\Model
{
   /**
    *
   withdraw status: 0 = pending, 1 = verified, 2 = approved, 3 = discarded, 4 = scheduled, 5 = disbursed

    */
    protected $table = 'withdraws';
    protected $primaryKey = 'withdraw_id';
    protected $allowedFields = ['withdraw_id', 'withdraw_staff_id', 'withdraw_ct_id', 'withdraw_amount', 'withdraw_charges', 'withdraw_date', 'withdraw_narration', 'withdraw_status', 'withdraw_doc', 'withdraw_verify_by',
        'withdraw_verify_comment', 'withdraw_verify_date', 'withdraw_approved_by', 'withdraw_approved_date', 'withdraw_approved_comment',
        'withdraw_discarded_by', 'withdraw_discarded_date', 'cart', 'withdraw_discarded_comment', 'withdraw_disbursed_date', 'scheduled', 'disburse', 'disburse_date'];


        public function get_pending_withdrawals(){
            $builder = $this->db->table('withdraws');
            $builder->join('cooperators', 'cooperators.cooperator_staff_id = withdraws.withdraw_staff_id');
            $builder->join('contribution_type', 'contribution_type.contribution_type_id = withdraws.withdraw_ct_id');
            $builder->where('withdraws.withdraw_status', 0);
            return $builder->get()->getResultArray();

        }

        public function get_verified_withdrawals(){

            $builder = $this->db->table('withdraws');
            $builder->join('cooperators', 'cooperators.cooperator_staff_id = withdraws.withdraw_staff_id');
            $builder->join('contribution_type', 'contribution_type.contribution_type_id = withdraws.withdraw_ct_id');
            $builder->where('withdraws.withdraw_status', 1);
            return $builder->get()->getResultArray();

        }

    public function getScheduledWithdrawal(){
        $builder = $this->db->table('withdraws');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = withdraws.withdraw_staff_id');
        //$builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->where('withdraws.cart = 0');
        $builder->where('withdraw_status', 2);
        return $builder->get()->getResultObject();
    }
	
	#Items in cart
	public function getWithdrawItemsInCart(){
		$builder = $this->db->table('withdraws');
		$builder->join('cooperators', 'cooperators.cooperator_staff_id = withdraws.withdraw_staff_id');
		//$builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
		$builder->join('banks', 'cooperators.cooperator_bank_id = banks.bank_id');
		$builder->where('withdraws.cart = 1');
		$builder->where('withdraws.scheduled = 0');
		return $builder->get()->getResultObject();
	}
	
	#Approved loans
	public function getApprovedWithdraws(){
		$builder = $this->db->table('withdraws');
		$builder->join('cooperators', 'cooperators.cooperator_staff_id = withdraws.withdraw_staff_id');
		//$builder->join('loan_setups', 'withdraws.loan_type = loan_setups.loan_setup_id');
		$builder->where('withdraws.cart = 0');
		return $builder->get()->getResultObject();
	}


    public function getAllWithdrawApplications(){
		$builder = $this->db->table('withdraws');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = withdraws.withdraw_staff_id');
		$builder->orderBy('withdraws.withdraw_date', 'DESC');
        return $builder->get()->getResultObject();
	}
	
}
