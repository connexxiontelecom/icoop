<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApplicationDateCreated extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_date' => [
                'type' => 'date',
                'after' => 'application_sort_code'
            ],

            'application_approved_comment' => [
                'type' => 'text',
                'null' => true,
                'default' => 'CURRENT_TIMESTAMP',
                'after' => 'application_approved_date'
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
