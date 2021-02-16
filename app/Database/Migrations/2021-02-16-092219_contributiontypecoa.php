<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contributiontypecoa extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'contribution_type_glcode' => [
				'type' => 'TEXT',
				'null' => 'true',
			
			],
			
		
		
		
		
		
		];
		$this->forge->addColumn('contribution_type', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
