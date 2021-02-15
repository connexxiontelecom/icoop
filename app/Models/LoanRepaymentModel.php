<?php
	
	
	namespace App\Models;
	//1 = CREDIT, 2 = DEBIT
	
	class LoanRepaymentModel extends \CodeIgniter\Model
	{
		protected $table = 'loan_repayments';
		protected $primaryKey = 'lr_id';
		protected $allowedFields = ['lr_id', 'lr_loan_id',	'lr_month',	'lr_year', 'pd_amount', 'lr_amount', 'lr_narration', 'lr_dctype', 'lr_ref', 'lr_mi', 'lr_mpr', 'lr_interest', 'lr_interest_rate', 'lr_date' ];
		
		
		public function get_year_loan($staff_id){
			
			$builder = $this->db->query("select year(loan_repayments.lr_date) as year from loan_repayments INNER JOIN loans
											ON loans.loan_id = loan_repayments.lr_loan_id where loans.staff_id = '$staff_id'
										 	group by year(loan_repayments.lr_date)");
			
			return $builder->getResultArray();
		}
		
		public function get_staff_loans($staff_id){
		
		
		
		}
		
	}
	

