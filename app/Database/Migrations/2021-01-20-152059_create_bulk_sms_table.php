<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBulkSmsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'bulksms_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'sender_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'receivers'=>[
					'type'=>'TEXT',
					'null'=>true,
				],
				'message'=>[
					'type'=>'TEXT',
					'null'=>true
				]


			]
		);
		$this->forge->addKey('bulksms_id', true);
		$this->forge->createTable('bulksms');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
