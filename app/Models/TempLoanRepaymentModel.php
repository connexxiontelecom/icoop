<?php
	
	
	namespace App\Models;
	
	
	class TempLpModel extends \CodeIgniter\Model
	{
		protected $table = 'temp_loan_repayment';
		protected $primaryKey = 'temp_lr_id';
		protected $allowedFields = ['temp_lr_id', 'temp_lr_staff_id', 'temp_lr_staff_name',	'temp_lr_transaction_date',	'temp_lr_narration', 'temp_lr_amount', 'temp_lr_drcrtype', 'temp_lr_loan_id', 'temp_lr_ref_code', 'temp_lr_status'];
		
		
		public function delete_temp(){
			
			$builder = $this->db->table('temp_loan_repayment');
			$builder->emptyTable();
			
		}
		
	}
