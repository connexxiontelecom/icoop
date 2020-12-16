<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applications extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_gender' => [
                'type' => 'TEXT',
                'after' => 'application_other_name'
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
