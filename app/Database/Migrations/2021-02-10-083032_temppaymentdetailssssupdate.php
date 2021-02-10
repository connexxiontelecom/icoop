<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Temppaymentdetailssssupdate extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'temp_pd_staff_name' => [
				'type' => 'TEXT',
				'null' => true
			
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
