<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Receipttablecoopbank extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'rm_coop_bank' => [
				'type' => 'INT',
				'null' => 'true',
				'after' => 'rm_payment_method'
			
			],
		
		
		
		
		
		
		];
		$this->forge->addColumn('receipt_master', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
