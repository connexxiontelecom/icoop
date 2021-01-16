<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PaymentDetailsdbUPdate extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
                'pd_ct_id' => [
                    'after' => 'pd_drcrtype',
                    'type' => 'INT',
                ],

                'pd_pg_id' => [
                    'after' => 'pd_ct_id',
                    'type' => 'INT',
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
