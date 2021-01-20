<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMailReceiversTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'mail_receiver_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'mail_id' =>[
					'type' => 'INT',
					'null'=>true,
				]


			]
		);
		$this->forge->addKey('mail_receiver_id', true);
		$this->forge->createTable('mail_receivers');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
