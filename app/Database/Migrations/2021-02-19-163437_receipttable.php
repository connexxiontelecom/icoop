<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Receipttable extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'rm_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'rm_staff_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'rm_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'rm_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
				],
				
				'rm_payment_method'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'rm_status'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'rm_verify_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'rm_verify_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'rm_verify_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'rm_approve_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'rm_approve_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'rm_approve_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'rm_discard_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'rm_discard_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'rm_discard_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				
			]
		);
		$this->forge->addKey('rm_id', true);
		$this->forge->createTable('receipt_master');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
