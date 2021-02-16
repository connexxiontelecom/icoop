<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Entrypaymentmasters extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'entry_payment_master_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'entry_payment_bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'entry_payment_payable_date' =>[
					'type' => 'DATETIME',
					'null'=>true,
				],
				'entry_payment_cheque_no' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'entry_payment_verified' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0,
					'comment'=>'0=unverified,1=verified'
				],
				'entry_payment_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'entry_payment_verified_by' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'entry_payment_approved' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0,
					'comment'=>'0=not approved, 1=approved'
				],
				'entry_payment_date_verified' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'entry_payment_approved_by' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'entry_payment_approved_date' =>[
					'type' => 'DATE',
					'null'=>true
				]


			]
		);
		$this->forge->addKey('entry_payment_master_id', true);
		$this->forge->createTable('entry_payment_masters');
	}

	public function down()
	{
		//
	}
}
