<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Receiptdetailtable extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'rd_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'rd_rm_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'rd_amount' =>[
					'type' => 'DOUBLE',
					'null'=>true,
				],
				'rd_type' =>[
					'type' => 'INT',
					'null'=>true,
				],
				
				'rd_target'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				
			]
		);
		$this->forge->addKey('rd_id', true);
		$this->forge->createTable('receipt_detail');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
