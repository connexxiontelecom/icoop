<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addencumbrancefield extends Migration
{
	public function up()
	{
		$fields = [
			'encumbrance_amount' => [
				'type' => 'DOUBLE',
				'null'=>true,
				'default'=>0
			
			]	
		];
		$this->forge->addColumn('loans', $fields);
	}

	public function down()
	{
		//
	}
}
