<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Receiptupdatesdateste extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'rm_by' => [
				'type' => 'TEXT',
			
			],
		
		];
		$this->forge->modifyColumn('receipt_master', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
