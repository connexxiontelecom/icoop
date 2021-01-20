<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApplicationSavings extends Migration
{
	public function up()
	{
		//

        $this->db->disableForeignKeyChecks();
        $fields = [
            'application_savings' => [
                'type' => 'double',
                'after' => 'application_date'
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
