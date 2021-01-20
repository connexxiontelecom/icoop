<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentDetailsdbUP extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'pd_amount' => [
                'after' => 'pd_narration',
                'type' => 'DOUBLE',

            ],

        ];
        $this->forge->addColumn('payment_details', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
