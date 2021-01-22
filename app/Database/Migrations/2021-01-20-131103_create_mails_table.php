<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMailsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'mail_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'subject' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'body' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'sent_by' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'created_at'=>[
					'type'=>'DATETIME',
					'null'=>true,
				],


			]
		);
		$this->forge->addKey('mail_id', true);
		$this->forge->createTable('mails');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
