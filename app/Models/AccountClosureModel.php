<?php
	
	
	namespace App\Models;
	
	
	class AccountClosureModel extends \CodeIgniter\Model
	{
		protected $table = 'account_closure';
		protected $primaryKey = 'ac_id';
		protected $allowedFields = ['ac_id', 'ac_staff_id', 'ac_effective_date', 'ac_mailing', 'ac_email', ' ac_phone',
		 'ac_verify_comment', 'ac_verify_by', 'ac_verify_date', 'ac_approve_comment', 'ac_approve_by', 'ac_approve_date',
			'ac_discard_comment', 'ac_discard_by', 'ac_discard_date', 'ac_a_date', 'ac_by', 'ac_status'];
		
		
	}
