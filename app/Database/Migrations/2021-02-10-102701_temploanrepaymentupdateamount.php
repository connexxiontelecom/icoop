<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Temploanrepaymentupdateamount extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'temp_lr_amount' => [
				'type' => 'DOUBLE',
				'after' => 'temp_lr_narration',
			
			
			],
			
			
		];
		$this->forge->addColumn('temp_loan_repayment', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
