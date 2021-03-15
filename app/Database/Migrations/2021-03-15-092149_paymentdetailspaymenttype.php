<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paymentdetailspaymenttype extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'pd_payment_type' => [
				'type' => 'INT',
				'after' => 'pd_amount',
			
			
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
