<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Thirdpartypaymententry extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'third_party_payment_entry_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'entry_payment_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'entry_bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'entry_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'entry_gl_account_no'=>[
					'type'=>'INT',
					'null'=>true,
				],
				'entry_reference_no'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'entry_narration'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'entry_payee_name'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'entry_payee_bank'=>[
					'type'=>'INT',
					'null'=>true
				],
				'entry_bank_account_no'=>[
					'type'=>'INT',
					'null'=>true
				],
				'entry_sort_code'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'entry_approved' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0,
					'comment'=>'0=not approved, 1=approved'
				],
				'entry_approved_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'entry_approved_by' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'entry_verified_by' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'entry_verified' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0
				],
				'entry_date_verified' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'cart' =>[
					'type' => 'INT',
					'null'=>true,
					'comment'=>'0=not,1=in cart'
				],
				'entry_attachment' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				

			]
		);
		$this->forge->addKey('third_party_payment_entry_id', true);
		$this->forge->createTable('third_party_payment_entries');
	}

	public function down()
	{
		//
	}
}
