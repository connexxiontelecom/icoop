<?php
	
	
	namespace App\Models;
	
	
	class JournalTransferdetailModel extends \CodeIgniter\Model
	{
		protected $table = 'journal_transfer_detail';
		protected $primaryKey = 'jtd_id';
		protected $allowedFields = ['jtd_id', 'jtd_jtm_id', 'jtd_amount', 'jtd_type', 'jtd_target'];
	}
