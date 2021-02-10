<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exceptionupdatename extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'exception_staff_name' => [
				'type' => 'TEXT',
				'null' => true
			
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
