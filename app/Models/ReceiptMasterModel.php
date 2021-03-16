<?php
	
	
	namespace App\Models;
	
	// 1 is loan, 2 is savings
	class ReceiptMasterModel extends \CodeIgniter\Model
	{
		protected $table = 'receipt_master';
		protected $primaryKey = 'rm_id';
		protected $allowedFields = ['rm_id', 'rm_staff_id', 'rm_date', 'rm_amount', 'rm_payment_method', 'rm_coop_bank',
			'rm_status', 'rm_verify_comment', 'rm_verify_by', 'rm_verify_date', 'rm_approve_comment', 'rm_approve_by', 'rm_approve_date',
			'rm_discard_comment', 'rm_discard_by', 'rm_discard_date', 'rm_a_date', 'rm_by'];
		
		public function get_receipts($status){
			$builder = $this->db->table('receipt_master');
			$builder->join('cooperators', 'cooperators.cooperator_staff_id = receipt_master.rm_staff_id');
			$builder->join('coop_banks', 'coop_banks.coop_bank_id = receipt_master.rm_coop_bank');
			$builder->join('banks', 'coop_banks.bank_id = banks.bank_id');
			$builder->join('coas', 'coas.glcode = coop_banks.glcode');
			$builder->where('receipt_master.rm_status', $status);
			return $builder->get()->getResultArray();
		}
		public function generateMemberReport($from, $to){
			$builder = $this->db->table('receipt_master');
			$builder->join('coop_banks', 'receipt_master.rm_coop_bank = coop_banks.coop_bank_id');
			$builder->join('coas', 'coas.glcode = coop_banks.glcode');
			$builder->join('cooperators', 'cooperators.cooperator_staff_id = receipt_master.rm_staff_id');
			$builder->where('receipt_master.rm_status = 2');
			$builder->where('receipt_master.rm_approve_date >= ', $from);
			$builder->where('receipt_master.rm_approve_date <= ', $to);
			return $builder->get()->getResultObject();
		}
		public function getReceiptDetailsById($receiptId){
			$builder = $this->db->table('receipt_master');
			$builder->join('coop_banks', 'receipt_master.rm_coop_bank = coop_banks.coop_bank_id');
			$builder->join('coas', 'coas.glcode = coop_banks.glcode');
			$builder->join('cooperators', 'cooperators.cooperator_staff_id = receipt_master.rm_staff_id');
			$builder->where('receipt_master.rm_id = '.$receiptId);
			return $builder->get()->getRowObject();
		}
		
	}
