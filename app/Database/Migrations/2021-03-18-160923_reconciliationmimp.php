<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reconciliationmimp extends Migration
{
	public function up()
	{
		//
		$fields = [
			're_mpr' => [
				'type' => 'FLOAT',
				'after' => 're_amount',
				'null' => 'true'
			
			
			],
			
			're_mi' => [
				'type' => 'FLOAT',
				'after' => 're_mpr',
				'null' => 'true'
			
			
			],
		
		
		
		];
		$this->forge->addColumn('reconciliation', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
