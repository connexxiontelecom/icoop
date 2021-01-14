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