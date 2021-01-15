<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentDetailsdb extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'pd_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'pd_staff_id' =>[
                    'type' => 'TEXT',
                ],
                'pd_transaction_date' =>[
                    'type' => 'DATE',

                ],
                'pd_narration' =>[
                    'type' => 'TEXT',

                ],

                'pd_drcrtype' =>[
                    'type' => 'INT',

                ],

                'pd_ref_code' =>[
                    'type' => 'TEXT',

                ],


            ]
        );
        $this->forge->addKey('pd_id', true);
        $this->forge->createTable('payment_details');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
