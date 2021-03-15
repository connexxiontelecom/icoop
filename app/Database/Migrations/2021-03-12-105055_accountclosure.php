<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Accountclosure extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'ac_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'ac_staff_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'ac_effective_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'ac_mailing' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'ac_email'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_phone'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_a_date' => [
					'type' => 'DATE',
					'null'=>true,
				
				],
				
				'ac_by' => [
					'type' => 'TEXT',
				
				],
				
				'ac_verify_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_verify_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_verify_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'ac_approve_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_approve_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_approve_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'ac_discard_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_discard_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'ac_discard_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'ac_status'=>[
					'type' => 'INT',
			
				],
			
			
			
			
			
			
			
			]
		);
		$this->forge->addKey('ac_id', true);
		$this->forge->createTable('account_closure');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
