<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addencumbrancefieldloanapp extends Migration
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
		$this->forge->addColumn('loan_applications', $fields);
	}

	public function down()
	{
		//
	}
}
