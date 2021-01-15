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
				'schedule_date' =>[
					'type' => 'DATETIME',
					'null'=>true,
				],
				'bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				]


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
