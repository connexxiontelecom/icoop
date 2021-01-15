<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cooperatorsusername extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'cooperator_username' => [
                'type' => 'text',
                'after' => 'cooperator_staff_id'
            ],

            'cooperator_password' => [
                'type' => 'text',
                'after' => 'cooperator_username'
            ],


        ];
        $this->forge->addColumn('cooperators', $fields);
        $this->forge->addUniqueKey(['cooperator_username']);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
