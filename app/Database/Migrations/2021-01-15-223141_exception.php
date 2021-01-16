<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Exception extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'exception_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'exception_staff_id' =>[
                    'type' => 'TEXT',
                ],

                'exception_transaction_date' =>[
                    'type' => 'DATE',

                ],
                'exception_amount' =>[
                    'type' => 'TEXT',

                ],

                'exception_ref_code' =>[
                    'type' => 'TEXT',

                ],



            ]
        );
        $this->forge->addKey('exception_id', true);
        $this->forge->createTable('exceptions');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
