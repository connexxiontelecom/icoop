<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdrawdoc extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'withdraw_doc' => [
                'type' => 'TEXT',
                'after' => 'withdraw_status',
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
