<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reconciliationrefno extends Migration
{
	public function up()
	{
		//
		$fields = [
			're_ref_no' => [
				'type' => 'TEXT',
				'after' => 're_transaction_date',
			
			
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
