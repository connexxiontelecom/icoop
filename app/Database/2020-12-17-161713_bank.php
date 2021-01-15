<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bank extends Migration
{
    public function up()
    {
        //
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'bank_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],

                'bank_name' =>[
                    'type' => 'TEXT',
                ],



            ]
        );
        $this->forge->addKey('bank_id', true);
        $this->forge->addUniqueKey(['bank_name']);
        $this->forge->createTable('banks');
    }

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
