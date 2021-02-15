<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ExceptionUpdates extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'exception_reason' => [
				'type' => 'TEXT',
				'null' => 'true',
				
			],
			
	
		
		
		];
		$this->forge->addColumn('exceptions', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
