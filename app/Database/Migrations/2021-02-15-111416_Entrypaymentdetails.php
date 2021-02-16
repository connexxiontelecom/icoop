<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Entrypaymentdetails extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'entry_payment_d_detail_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'entry_payment_d_master_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'entry_payment_d_payee_bank' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'entry_payment_d_payee_name' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'entry_payment_d_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'entry_payment_d_bank_name' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'entry_payment_d_account_no' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'entry_payment_d_reference_no' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'entry_payment_d_gl_account_no' =>[
					'type' => 'INT',
					'null'=>true,
				],


			]
		);
		$this->forge->addKey('entry_payment_d_detail_id', true);
		$this->forge->createTable('entry_payment_details');
	}

	public function down()
	{
		//
	}
}
