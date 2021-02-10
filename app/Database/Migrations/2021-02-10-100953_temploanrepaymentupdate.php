<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Temploanrepaymentupdate extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'temp_lr_month' => [
				'type' => 'TEXT',
				'after' => 'temp_lr_narration',
				'null' => true,
			
			],
			
			'temp_lr_year' => [
				'type' => 'TEXT',
				'after' => 'temp_lr_month',
				'null' => true,
			
			],
		
		
		];
		$this->forge->addColumn('temp_loan_repayment', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
