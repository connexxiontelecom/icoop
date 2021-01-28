<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdrawupdate extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'withdraw_narration' => [
                'type' => 'TEXT',
                'after' => 'withdraw_date',
                'null' => true

            ],

        ];
        $this->forge->addColumn('withdraws', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
