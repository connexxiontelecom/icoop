<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contributiontype extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'contribution_type_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],

                'contribution_type_name' =>[
                    'type' => 'TEXT',
                ],


                     ]
        );
        $this->forge->addKey('contribution_type_id', true);
        $this->forge->addUniqueKey(['contribution_type_name']);
        $this->forge->createTable('contribution_type');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
