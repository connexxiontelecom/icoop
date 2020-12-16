<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applications extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_status' => [
                'type' => 'INT',
                'default' => 0
            ],

        ];
        $this->forge->addColumn('applications', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
