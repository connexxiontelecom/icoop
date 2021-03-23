<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reconciliationupdate extends Migration
{
	public function up()
	{
		//
		$fields = [
			're_discard_by' => [
				'type' => 'TEXT',
				'after' => 're_approved_comment',
			
			
			],
			
			're_discard_comment' => [
				'type' => 'TEXT',
				'after' => 're_discard_by',
			
			
			],
			
			're_discard_date' => [
				'type' => 'DATE',
				'after' => 're_discard_comment',
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
