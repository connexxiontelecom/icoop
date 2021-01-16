<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TemppaymentDetailsdbUPdate extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'temp_pd_ct_id' => [
                'after' => 'temp_pd_drcrtype',
                'type' => 'INT',
            ],

            'temp_pd_pg_id' => [
                'after' => 'temp_pd_ct_id',
                'type' => 'INT',
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
