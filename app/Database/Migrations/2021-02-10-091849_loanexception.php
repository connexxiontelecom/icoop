<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loanexception extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'loan_exception_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'loan_exception_staff_id' =>[
					'type' => 'TEXT',
				],
				
				'loan_exception_staff_name' =>[
					'type' => 'TEXT',
					'null' => true,
				],
				
				'loan_exception_transaction_date' =>[
					'type' => 'DATE',
				
				],
				'loan_exception_amount' =>[
					'type' => 'TEXT',
				
				],
				
				'loan_exception_ref_code' =>[
					'type' => 'TEXT',
				
				],
			
			
			
			]
		);
		$this->forge->addKey('loan_exception_id', true);
		$this->forge->createTable('loan_exceptions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
