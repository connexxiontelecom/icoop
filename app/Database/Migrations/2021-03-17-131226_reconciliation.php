<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reconciliation extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				're_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				're_staff_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_type' =>[
					'type' => 'TEXT',
					'null'=>true,
					'comment'=>'1=savings, 2=loan'
				],
				
				're_narration' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_source' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_destination' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_amount' =>[
					'type' => 'FLOAT',
					'null'=>true,
				],
				
				're_dctype' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'1=credit to source, 2=debit to source'
				],
				
				're_transaction_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				
				're_by' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				
				're_verify_by' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_verify_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				
				're_verify_comment' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_approved_by' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_approved_date' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_approved_comment' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				're_status' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'0=pending, 1=verified 2=approved'
				],
				
	
			
			]
		);
		$this->forge->addKey('re_id', true);
		$this->forge->createTable('reconciliation');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
