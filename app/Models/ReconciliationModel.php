<?php
	
	
	namespace App\Models;
	
	
	class ReconciliationModel extends \CodeIgniter\Model
	{
		protected $table = 'reconciliation';
		protected $primaryKey = 're_id';
		protected $allowedFields = ['re_id', 're_staff_id', 're_type', 're_narration', 're_source', 're_destination',
			're_amount', 're_dctype', 're_transaction_date', 're_ref_no', 're_by', 're_date', 're_verify_by',  're_verify_date', 're_verify_comment', 're_approved_comment', 're_approved_by', 're_approved_date',
			're_discard_comment', 're_discard_by', 're_discard_date', 're_status'];
		
		
		public function get_reconciliations($type, $status){
			$builder = $this->db->table('reconciliation');
			if($type == 1): //savings
				$builder->join('contribution_type', 'contribution_type.contribution_type_id = reconciliation.re_source');
			endif;
			if($type == 2): //loans
				$builder->join('loans', 'loans.loan_id = reconciliation.re_source');
				$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
			endif;
			$builder->join('coas', 'coas.glcode = reconciliation.re_destination');
			$builder->join('cooperators', 'cooperators.cooperator_staff_id = reconciliation.re_staff_id');
			$builder->where('reconciliation.re_status', $status);
			return $builder->get()->getResultArray();
			
		}
	}
