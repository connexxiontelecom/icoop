<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdrawdisbursed extends Migration
{
	public function up()
	{
        //
        $this->db->disableForeignKeyChecks();
        $fields = [
            'withdraw_charges' => [
                'type' => 'DOUBLE',
                'after' => 'withdraw_amount',
                'null' => true

            ],

            'withdraw_disbursed_date' => [
                'type' => 'date',
                'after' => 'withdraw_discarded_comment',
                'null' => true

            ],



        ];
        $this->forge->addColumn('withdraws', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
