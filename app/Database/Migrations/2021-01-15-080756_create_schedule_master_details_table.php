<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateScheduleMasterDetailsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'schedule_master_detail_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'coop_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'loan_type' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'loan_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'schedule_master_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'transaction_type' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'1=loan,2=withdraw,3=closure'
				],


			]
		);
		$this->forge->addKey('schedule_master_detail_id', true);
		$this->forge->createTable('schedule_master_details');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
