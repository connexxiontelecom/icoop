<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Withdrawt extends Migration
{
	public function up()
	{
		//

        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'withdraw_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],

                'withdraw_staff_id' =>[
                    'type' => 'TEXT',
                ],

                'withdraw_ct_id' =>[
                    'type' => 'TEXT',
                ],

                'withdraw_amount' =>[
                    'type' => 'TEXT',
                ],

                'withdraw_date' =>[
                    'type' => 'TEXT',
                    'null' => true,
                ],


                'withdraw_verify_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'withdraw_verify_comment' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'withdraw_verify_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],

                'withdraw_approved_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'withdraw_approved_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],


                'withdraw_approved_comment' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],


                'withdraw_discarded_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'withdraw_discarded_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],

                'withdraw_discarded_comment' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],


            ]
        );
        $this->forge->addKey('withdraw_id', true);
//        $this->forge->addUniqueKey(['application_staff_id', 'application_email', 'application_telephone']);
        $this->forge->createTable('withdraws');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
