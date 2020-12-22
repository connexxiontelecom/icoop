<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paymentsupdate extends Migration
{
	public function up()
	{
		//

        $this->db->disableForeignKeyChecks();
        $fields = [
            'payment_narration' => [
                 'type' => 'TEXT',
                  'null' => true

            ],

            'payment_reference_code' => [
                'type' => 'TEXT',
                'null' => true

            ],

        ];
        $this->forge->modifyColumn('payments', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
