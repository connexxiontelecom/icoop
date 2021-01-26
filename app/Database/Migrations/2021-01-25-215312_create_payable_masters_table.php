<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePayableMastersTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'payable_master_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				'schedule_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'receivers'=>[
					'type'=>'TEXT',
					'null'=>true,
				],
				'payable_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'created_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'created_by'=>[
					'type'=>'INT',
					'null'=>true
				],
				'verified_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'verified_by'=>[
					'type'=>'INT',
					'null'=>true
				],
				'approve_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'approve_by'=>[
					'type'=>'INT',
					'null'=>true
				],
				'returned'=>[
					'type'=>'INT',
					'null'=>true,
					'default'=>0,
					'comment'=>'0=off,1=on'
				],
				'returned_by'=>[
					'type'=>'INT',
					'null'=>true
				],
				'reason'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'payable_no'=>[
					'type'=>'INT',
					'null'=>true
				],


			]
		);
		$this->forge->addKey('payable_master_id', true);
		$this->forge->createTable('payable_masters');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
