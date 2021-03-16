<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Userupdate extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'username' => [
				'type' => 'TEXT',
				'after' => 'email',
			
			
			],
			
			'user_status' => [
				'type' => 'INT',
				'after' => 'user_type',
				'null' => 'true'
			
			
			],
		
		
		];
		$this->forge->addColumn('users', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
