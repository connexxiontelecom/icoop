<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Policyconfigupdates extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();
        $fields = [
            'max_withdrawal_amount' => [
                'type' => 'DOUBLE',
                'after' => 'savings_withdrawal_charge',
                'null' => true

            ],

        ];
        $this->forge->addColumn('policy_configs', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
