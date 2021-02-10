<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loanrepaymentupdateint extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'lr_interest_rate' => [
				'type' => 'DOUBLE',
				'after' => 'lr_interest',
				'null' => true
			
			],
		
		
		];
		$this->forge->addColumn('loan_repayments', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
