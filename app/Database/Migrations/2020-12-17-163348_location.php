<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Location extends Migration
{
    public function up()
    {
        //
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'location_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],


                'location_name' =>[
                    'type' => 'TEXT',
                ]




            ]
        );
        $this->forge->addKey('location_id', true);
        $this->forge->addUniqueKey(['location_name']);
        $this->forge->createTable('locations');
    }

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
