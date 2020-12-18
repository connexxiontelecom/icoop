<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApplicationDateVerifyComment extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_verify_comment' => [
                'type' => 'text',
                'after' => 'application_verify_date'
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
