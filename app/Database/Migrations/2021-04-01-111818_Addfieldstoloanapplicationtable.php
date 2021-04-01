<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Addfieldstoloanapplicationtable extends Migration
{
	public function up()
	{
		$fields = [
			'disapproved_by' => [
				'type' => 'TEXT',
				'null'=>true,			
			],	
			'date_disapproved' => [
				'type' => 'DATETIME',
				'null'=>true,			
			],	
			'disapproved' => [
				'type' => 'INT',
				'null'=>true,		
				'default'=>0	
			],	
		];
		$this->forge->addColumn('loan_applications', $fields);
	}

	public function down()
	{
		//
	}
}
