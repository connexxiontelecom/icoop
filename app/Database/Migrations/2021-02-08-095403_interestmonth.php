<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Interestmonth extends Migration
{
	public function up()
	{
		//
		//
		
		$this->db->disableForeignKeyChecks();
		
		$this->forge->addField(
			[
				'ir_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'ir_month' =>[
					'type' => 'TEXT',
				],
				
				'ir_year' =>[
					'type' => 'TEXT',
				],
				
				'ir_date' =>[
					'type' => 'TEXT',
				],
				
			]
		);
		$this->forge->addKey('ir_id', true);
		$this->forge->createTable('interest_routines');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
