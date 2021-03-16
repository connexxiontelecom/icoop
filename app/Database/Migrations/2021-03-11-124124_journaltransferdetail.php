<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Journaltransfejtdetail extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'jtd_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'jtd_jtm_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'jtd_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
				],
				'jtd_type' =>[
					'type' => 'INT',
					'null'=>true,
				],
				
				'jtd_target'=>[
					'type'=>'INT',
					'null'=>true
				],
			
			
			]
		);
		$this->forge->addKey('jtd_id', true);
		$this->forge->createTable('journal_transfer_detail');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
