<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exceptionmonthyear extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'exception_month' => [
				'type' => 'INT',
				'null' => 'true',
			
			],
			
			'exception_year' => [
				'type' => 'INT',
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
