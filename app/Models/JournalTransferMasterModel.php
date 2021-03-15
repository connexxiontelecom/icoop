<?php
	
	
	namespace App\Models;
	
	
	class JournalTransferMasterModel extends \CodeIgniter\Model
	{
		protected $table = 'journal_transfer_master';
		protected $primaryKey = 'jtm_id';
		protected $allowedFields = ['jtm_id', 'jtm_staff_id', 'jtm_date', 'jtm_amount', 'jtm_payment_method', 'jtm_ct_id',
			'jtm_status', 'jtm_verify_comment', 'jtm_verify_by', 'jtm_verify_date', 'jtm_approve_comment', 'jtm_approve_by', 'jtm_approve_date',
			'jtm_discard_comment', 'jtm_discard_by', 'jtm_discard_date', 'jtm_a_date', 'jtm_by'];
		
		public function get_receipts($status){
			$builder = $this->db->table('journal_transfer_master');
			$builder->join('cooperators', 'cooperators.cooperator_staff_id = journal_transfer_master.jtm_staff_id');
			$builder->join('contribution_type', 'contribution_type.contribution_type_id = journal_transfer_master.jtm_ct_id');
			$builder->where('journal_transfer_master.jtm_status', $status);
			return $builder->get()->getResultArray();
		}
		
		public function generateMemberReport($from, $to){
			$builder = $this->db->table('journal_transfer_master');
			$builder->join('coop_banks', 'journal_transfer_master.jtm_coop_bank = coop_banks.coop_bank_id');
			$builder->join('coas', 'coas.glcode = coop_banks.glcode');
			$builder->join('cooperators', 'cooperators.cooperator_staff_id = journal_transfer_master.jtm_staff_id');
			$builder->where('journal_transfer_master.jtm_status = 2');
			$builder->where('journal_transfer_master.jtm_approve_date >= ', $from);
			$builder->where('journal_transfer_master.jtm_approve_date <= ', $to);
			return $builder->get()->getResultObject();
		}
	}
