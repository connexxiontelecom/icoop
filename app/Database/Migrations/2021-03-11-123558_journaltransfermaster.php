<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Journaltransfejtmaster extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'jtm_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'jtm_staff_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'jtm_date' =>[
					'type' => 'DATE',
					'null'=>true,
				],
				'jtm_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
				],
				
				'jtm_payment_method'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'jtm_status'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'jtm_ct_id'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'jtm_verify_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'jtm_verify_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'jtm_verify_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'jtm_approve_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'jtm_approve_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'jtm_approve_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'jtm_discard_comment'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'jtm_discard_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'jtm_discard_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'jtm_a_date' => [
					'type' => 'DATE',
					'null'=>true,
				
				],
				
				'jtm_by' => [
					'type' => 'TEXT',
				
				],
			
			
			]
		);
		$this->forge->addKey('jtm_id', true);
		$this->forge->createTable('journal_transfer_master');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
