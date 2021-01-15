<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TempPaymentDetailsdb extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $this->forge->addField(
            [
                'temp_pd_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'temp_pd_staff_id' =>[
                    'type' => 'TEXT',
                ],
                'temp_pd_transaction_date' =>[
                    'type' => 'DATE',

                ],
                'temp_pd_narration' =>[
                    'type' => 'TEXT',

                ],

                'temp_pd_drcrtype' =>[
                    'type' => 'INT',

                ],

                'temp_pd_ref_code' =>[
                    'type' => 'TEXT',

                ],

                'temp_pd_status' =>[
                    'type' => 'INT',

                ],




            ]
        );
        $this->forge->addKey('temp_pd_id', true);
        $this->forge->createTable('temp_payment_details');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
