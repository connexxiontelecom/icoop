<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdrawstatus extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'withdraw_status' => [
                'type' => 'INT',
                'after' => 'withdraw_narration',
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
