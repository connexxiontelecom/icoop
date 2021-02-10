<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loanexceptionupdate extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'loan_exception_month' => [
				'type' => 'TEXT',
				'after' => 'loan_exception_transaction_date',
				'null' => true,
			
			],
			
			'loan_exception_year' => [
				'type' => 'TEXT',
				'after' => 'loan_exception_month',
				'null' => true,
			
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
