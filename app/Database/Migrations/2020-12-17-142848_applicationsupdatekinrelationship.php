<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applicationsupdatekinrelationship extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_relationship' => [
                'name' => 'application_kin_relationship',
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
