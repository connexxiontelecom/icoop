<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoopBanksTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'coop_bank_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],

				'branch' =>[
					'type' => 'VARCHAR',
					'null'=>true,
					'default'=>'No branch',
					'constraint'=>50
				],
				'account_no' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'description' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'glcode' =>[
					'type' => 'INT',
					'null'=>true
				],
				'created_at'=>[
					'type'=>'DATETIME',
					'null'=>true
				]



			]
		);
		$this->forge->addKey('coop_bank_id', true);
		$this->forge->createTable('coop_banks');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
