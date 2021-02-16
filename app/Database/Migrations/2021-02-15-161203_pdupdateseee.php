<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pdupdateseee extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'pd_month' => [
				'type' => 'INT',
				'null' => 'true',
			
			],
			
			'pd_year' => [
				'type' => 'INT',
				'null' => 'true',
			
			],
		
		
		
		
		];
		$this->forge->addColumn('payment_details', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
