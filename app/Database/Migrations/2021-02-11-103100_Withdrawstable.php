<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdrawstable extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'cart' => [
                    'type' => 'INT',
                    'null' => 'true',
                    'default'=>0

                ],
                'paid_back' => [
                    'type' => 'INT',
                    'null' => 'true',
                    'default'=>0

                ],
                'disburse' => [
                    'type' => 'INT',
                    'null' => 'true',
                    'default'=>0

                ],
                'scheduled' => [
                    'type' => 'INT',
                    'null' => 'true',
                    'default'=>0

                ],
                'disburse_date' => [
                    'type' => 'DATETIME',
                    'null' => 'true',
                    
                ],
			
			
		];
		$this->forge->addColumn('withdraws', $fields);
	}

	public function down()
	{
		//
	}
}
