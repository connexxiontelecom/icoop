<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomerSetupsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'customer_setup_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'customer_name' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'contact_person' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'email' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'phone_no'=>[
					'type'=>'TEXT',
					'null'=>true,
				],
				'gl_account_code'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				

			]
		);
		$this->forge->addKey('customer_setup_id', true);
		$this->forge->createTable('customer_setups');
	}

	public function down()
	{
		//
	}
}