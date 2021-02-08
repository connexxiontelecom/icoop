<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loanrepayment extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'lr_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'lr_loan_id' =>[
					'type' => 'INT',
				],
				
				
				'lr_month' =>[
					'type' => 'TEXT',
				],
				
				'lr_year' =>[
					'type' => 'TEXT',
				],
				
				'lr_amount' =>[
					'type' => 'DOUBLE',
				],
				
				'lr_narration' =>[
					'type' => 'TEXT',
				],
				
				'lr_dctype' =>[
					'type' => 'INT',
				],
				
				'lr_ref' =>[
					'type' => 'TEXT',
				],
				
				'lr_mi' =>[
					'type' => 'DOUBLE',
				],
				
				'lr_mpr' =>[
					'type' => 'DOUBLE',
				],
				
				'lr_interest' =>[
					'type' => 'INT',
				],
				
				'lr_date' =>[
					'type' => 'TEXT',
				],
			
			]
		);
		$this->forge->addKey('lr_id', true);
		$this->forge->createTable('loan_repayments');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
