<?php
	
	
	namespace App\Models;
	//1 = CREDIT, 2 = DEBIT
	
	class LoanRepaymentModel extends \CodeIgniter\Model
	{
		protected $table = 'loan_repayments';
		protected $primaryKey = 'lr_id';
		protected $allowedFields = ['lr_id', 'lr_loan_id',	'lr_month',	'lr_year', 'pd_amount', 'lr_amount', 'lr_narration', 'lr_dctype', 'lr_ref', 'lr_mi', 'lr_mpr', 'lr_interest', 'lr_date' ];
		
		
	}
	

