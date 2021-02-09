<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contributiontypesregular extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'contribution_type_regular' => [
				'type' => 'INT',
				'null' => true
			
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
