<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayableDetailsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'payable_detail_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'payable_master_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'schedule_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'app_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'payable_no'=>[
					'type'=>'TEXT',
					'null'=>true,
				],
				'type'=>[
					'type'=>'INT',
					'null'=>true
				]


			]
		);
		$this->forge->addKey('payable_detail_id', true);
		$this->forge->createTable('payable_details');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
