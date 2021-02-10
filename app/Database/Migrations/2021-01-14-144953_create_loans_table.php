<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoansTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'loan_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'staff_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'loan_app_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'loan_type' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'interest' =>[
					'type' => 'DOUBLE',
					'null'=>true
				],
				'interest_rate' =>[
					'type' => 'DOUBLE',
					'null'=>true
				],
				'disburse' =>[
					'type' => 'INT',
					'default'=>0,
					'null'=>true
				],
				'cart' =>[
					'type' => 'INT',
					'default'=>0,
					'null'=>true
				],
				'schedule_master_id' =>[
					'type' => 'INT',
					'null'=>true
				],
				'disburse_date' =>[
					'type' => 'DATETIME',
					'null'=>true
				],
				'paid_back' =>[
					'type' => 'INT',
					'default'=>0,
					'null'=>true,
					'comment'=>'0=no, 1=yes'
				],
				'scheduled' =>[
					'type' => 'INT',
					'default'=>0,
					'null'=>true,
					'comment'=>'0=not scheduled, 1=scheduled'
				],
				'created_at'=>[
					'type'=>'DATETIME',
					'null'=>true
				],


			]
		);
		$this->forge->addKey('loan_id', true);
		$this->forge->createTable('loans');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
