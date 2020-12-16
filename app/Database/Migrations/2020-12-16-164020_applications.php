<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applications extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application__address' => [
                'name' => 'application_address',
                'type' => 'TEXT',

            ],

        ];
        $this->forge->modifyColumn('applications', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
