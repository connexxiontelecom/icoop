<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Loansetupup extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'interest_rate' => [
				'name' => 'ls_interest_rate',
				'type' => 'TEXT',
			
			],
		
		];
		$this->forge->modifyColumn('loan_setups', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
