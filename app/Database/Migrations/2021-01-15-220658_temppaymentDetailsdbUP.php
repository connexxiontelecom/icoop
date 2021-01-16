<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TemppaymentDetailsdbUP extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'temp_pd_amount' => [
                'after' => 'temp_pd_narration',
                'type' => 'DOUBLE',

            ],

        ];
        $this->forge->addColumn('temp_payment_details', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
