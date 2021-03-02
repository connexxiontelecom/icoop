<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Receiptupdatesdates extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'rm_a_date' => [
				'type' => 'DATE',
				'null'=>true,
			
			],
			
			'rm_by' => [
				'type' => 'DATE',
				'null'=>true,
			
			],
		
		
		
		
		
		
		];
		$this->forge->addColumn('receipt_master', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
