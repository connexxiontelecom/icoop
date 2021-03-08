<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateScheduleMastersTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'schedule_master_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'payable_date' =>[
					'type' => 'DATETIME',
					'null'=>true,
				],
				'creation_date' =>[
					'type' => 'DATETIME',
					'null'=>true,
				],
				'bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'transaction_type' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'1=loan,2=withdraw,3=closure'
				],
				'loan_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'verified_by' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'verified' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0
				],
				'date_verified' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'approved' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0,
					'comment'=>'0=not approved, 1=approved'
				],
				'approved_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'approved_by' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'attachment' =>[
					'type' => 'TEXT',
					'null'=>true,
				],


			]
		);
		$this->forge->addKey('schedule_master_id', true);
		$this->forge->createTable('schedule_masters');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
