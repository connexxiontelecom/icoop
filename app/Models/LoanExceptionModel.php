<?php
	
	
	namespace App\Models;
	
	
	class LoanExceptionModel extends \CodeIgniter\Model
	{
		protected $table = 'loan_exceptions';
		protected $primaryKey = 'loan_exception_id';
		protected $allowedFields = ['loan_exception_id',	'loan_exception_staff_id', 'loan_exception_staff_name', 'loan_exception_transaction_date', 'loan_exception_month', 'loan_exception_year', 'loan_exception_amount',	'loan_exception_ref_code', 'loan_exception_reason', 'loan_exception_loan_type'];
		
		public function get_years(){
			$builder = $this->db->table('loan_exceptions');
			$builder->groupBy('loan_exceptions.loan_exception_year');
			return $builder->get()->getResultArray();
		}
	}
