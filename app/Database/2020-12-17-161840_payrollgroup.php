<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payrollgroup extends Migration
{
    public function up()
    {
        //
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'pg_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],


                'pg_name' =>[
                    'type' => 'TEXT',
                ],

                'pg_gl_code' =>[
                    'type' => 'TEXT',
                ],


            ]
        );
        $this->forge->addKey('pg_id', true);
        $this->forge->addUniqueKey(['pg_name']);
        $this->forge->createTable('payroll_groups');
    }
	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
