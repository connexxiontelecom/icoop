<?php
	
	
	namespace App\Models;
	
	// 1 is loan, 2 is savings for rd_type
	class ReceiptDetailModel extends \CodeIgniter\Model
	{
		protected $table = 'receipt_detail';
		protected $primaryKey = 'rd_id';
		protected $allowedFields = ['rd_id', 'rd_rm_id', 'rd_amount', 'rd_type', 'rd_target'];
		
		
		
	}
