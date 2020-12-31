<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateJournalVouchersTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField(
			[
				'journal_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'glcode' =>[
					'type' => 'INT',
				],
				'entry_by' =>[
					'type' => 'INT',
				],
				'narration' => [
					'type'=>'TEXT',
					'null'=>true
				],
				'name' => [
					'type'=>'TEXT',
					'null'=>true
				],
				'dr_amount'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'cr_amount'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'ref_no'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'jv_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'entry_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'posted'=>[
					'type'=>'INT',
					'default'=>0
				],
				'posted_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'trash'=>[
					'type'=>'INT',
					'default'=>0
				],
				'created_at'=>[
					'type'=>'DATETIME',
					'null'=>true
				]



			]
		);
		$this->forge->addKey('journal_id', true);
		$this->forge->createTable('journal_vouchers');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
