<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CustomerReceivablesTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'customer_receivable_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'cr_transaction_date' =>[
					'type' => 'DATETIME',
					'null'=>true,
				],
				'cr_coop_bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'cr_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'cr_purpose' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'cr_gl_cr' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'cr_customer_setup_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'cr_verify' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'1=verified,0=unverified',
					'default'=>0
				],
				'cr_approve' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'1=approved,0=not approved',
					'default'=>0
				],
				'cr_approved_by' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'cr_verified_by' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'cr_date_verified' =>[
					'type' => 'DATETIME',
					'null'=>true
				],
				'cr_date_approved' =>[
					'type' => 'DATETIME',
					'null'=>true
				],
				'cr_approve_comment' =>[
					'type' => 'TEXT',
					'null'=>true
				],


			]
		);
		$this->forge->addKey('customer_receivable_id', true);
		$this->forge->createTable('customer_receivables');
	}

	public function down()
	{
		//
	}
}
