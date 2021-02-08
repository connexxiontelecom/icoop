<?php
	
	
	namespace App\Models;
	
	
	class InterestRoutineModel extends \CodeIgniter\Model
	{
		protected $table = 'interest_routines';
		protected $primaryKey = 'ir_id';
		protected $allowedFields = ['ir_id', 'ir_month', 'ir_year', 'ir_date'];
		
	}
