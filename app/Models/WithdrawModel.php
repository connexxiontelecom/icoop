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
    protected $allowedFields = ['withdraw_id', 'withdraw_staff_id', 'withdraw_ct_id', 'withdraw_amount', 'withdraw_charges', 'withdraw_date', 'withdraw_narration', 'withdraw_status', 'withdraw_verify_by',
        'withdraw_verify_comment', 'withdraw_verify_date', 'withdraw_approved_by', 'withdraw_approved_date', 'withdraw_approved_comment',
        'withdraw_discarded_by', 'withdraw_discarded_date', 'withdraw_discarded_comment', 'withdraw_disbursed_date'];


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
}
