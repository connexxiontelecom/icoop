<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contributionpp extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'payment_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],

                'payment_staff_id' =>[
                    'type' => 'INT',
                ],


                'payment_amount' =>[
                    'type' => 'DOUBLE',
                ],

                'payment_contribution_type_id' =>[
                    'type' => 'INT',
                ],

                'payment_type' =>[
                    'type' => 'INT',
                ],

                'payment_narration' =>[
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'payment_date' =>[
                    'type' => 'date',
                ],

                'payment_reference_code' =>[
                    'type' => 'TEXT',
                ],

                'payment_action_by' =>[
                    'type' => 'TEXT',
                ],



            ]
        );
        $this->forge->addKey('payment_id', true);
        $this->forge->createTable('payments');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
