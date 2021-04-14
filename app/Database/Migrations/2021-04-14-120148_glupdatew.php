<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Glupdatew extends Migration
{
	public function up()
	{
		//
		$fields = [
			'gl_transaction_date' => [
				'type' => 'DATE',
				'after' => 'created_at',
				'null' => 'true'
			
			
			],
			
			'gl_description' => [
				'type' => 'TEXT',
				'after' => 'narration',
				'null' => 'true'
			
			
			],
		
		
		
		];
		$this->forge->addColumn('gls', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
