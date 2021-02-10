<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Temploanrepayment extends Migration
{
	public function up()
	{
		//
		
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'temp_lr_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'temp_lr_staff_id' =>[
					'type' => 'TEXT',
				],
				
				'temp_lr_staff_name' =>[
					'type' => 'TEXT',
					'null' => true,
				],
				
				'temp_lr_transaction_date' =>[
					'type' => 'DATE',
				
				],
				'temp_lr_narration' =>[
					'type' => 'TEXT',
				
				],
				
				'temp_lr_drcrtype' =>[
					'type' => 'INT',
				
				],
				
				'temp_lr_loan_id'=>[
				'type' => 'INT',
				],
				
				'temp_lr_ref_code' =>[
					'type' => 'TEXT',
				
				],
				
				'temp_lr_status' =>[
					'type' => 'INT',
				
				],
			
			
			
			
			]
		);
		$this->forge->addKey('temp_lr_id', true);
		$this->forge->createTable('temp_loan_repayment');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
