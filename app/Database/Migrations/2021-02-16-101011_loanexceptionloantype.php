<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loanexceptionloantype extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'loan_exception_loan_type' => [
				'type' => 'TEXT',
				'null' => 'true',
			
			],
		
		
		
		
		
		
		];
		$this->forge->addColumn('loan_exceptions', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
