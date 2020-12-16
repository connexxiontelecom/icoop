<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Applications extends Migration
{
	public function up()
	{
		//
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'application_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],

                'application_staff_id' =>[
                    'type' => 'TEXT',
                ],

                'application_first_name' =>[
                    'type' => 'TEXT',
                ],

                'application_last_name' =>[
                    'type' => 'TEXT',
                ],

                'application_other_name' =>[
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'application_department_id' =>[
                    'type' => 'TEXT',
                  ],

                'application_location_id' =>[
                    'type' => 'TEXT',
                ],

                'application_payroll_group_id' => [
                    'type' => 'TEXT',
                ],

                'application_dob' => [
                    'type' => 'TEXT',
                ],

                'application_email' => [
                    'type' => 'TEXT'
                ],

                'application__address' => [
                    'type' => 'TEXT'
                ],

                'application_city' => [
                    'type' => 'TEXT'
                ],

                'application_state_id' => [
                    'type' => 'TEXT'
                ],

                'application_telephone' => [
                    'type' => 'TEXT'
                ],

                'application_kin_fullname' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'application_kin_address' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'application_kin_email' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'application_kin_phone' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'application_relationship' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'application_bank_id' => [
                    'type' => 'INT'
                ],

                'application_account_number' => [
                    'type' => 'TEXT'
                ],

                'application_bank_branch' => [
                    'type' => 'TEXT'
                ],

                'application_sort_code' => [
                    'type' => 'TEXT'
                ],

                'application_verify_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'application_verify_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],

                'application_approved_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'application_approved_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],

                'application_discarded_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'application_discarded_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],
                'application_discarded_reason' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                     ]
        );
        $this->forge->addKey('application_id', true);
        $this->forge->addUniqueKey(['application_staff_id', 'application_email', 'application_telephone']);
        $this->forge->createTable('applications');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
