<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApplicationDateCreatedupdate extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_date' => [
                'type' => 'date',


            ],

            'application_approved_comment' => [
                'type' => 'text',
                'null' => true,
                'default' => null,

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
