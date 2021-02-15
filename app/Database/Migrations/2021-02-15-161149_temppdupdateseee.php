<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Temppdupdateseee extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'temp_pd_month' => [
				'type' => 'INT',
				'null' => 'true',
			
			],
			
			'temp_pd_year' => [
				'type' => 'INT',
				'null' => 'true',
			
			],
		
		
		
		
		];
		$this->forge->addColumn('temp_payment_details', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
