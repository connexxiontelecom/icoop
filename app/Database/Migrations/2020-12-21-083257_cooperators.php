<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cooperators extends Migration
{
    public function up()
    {
        //
        $this->db->disableForeignKeyChecks();

        $this->forge->addField(
            [
                'cooperator_id' =>[
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],

                'cooperator_application_id' =>[
                    'type' => 'INT',
                ],


                'cooperator_staff_id' =>[
                    'type' => 'TEXT',
                ],

                'cooperator_first_name' =>[
                    'type' => 'TEXT',
                ],

                'cooperator_last_name' =>[
                    'type' => 'TEXT',
                ],

                'cooperator_other_name' =>[
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_gender' =>[
                    'type' => 'text',
                ],

                'cooperator_department_id' =>[
                    'type' => 'TEXT',
                ],

                'cooperator_location_id' =>[
                    'type' => 'TEXT',
                ],

                'cooperator_payroll_group_id' => [
                    'type' => 'TEXT',
                ],

                'cooperator_dob' => [
                    'type' => 'TEXT',
                ],

                'cooperator_email' => [
                    'type' => 'TEXT'
                ],

                'cooperator_address' => [
                    'type' => 'TEXT'
                ],

                'cooperator_city' => [
                    'type' => 'TEXT'
                ],

                'cooperator_state_id' => [
                    'type' => 'TEXT'
                ],

                'cooperator_telephone' => [
                    'type' => 'TEXT'
                ],

                'cooperator_kin_fullname' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_kin_address' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_kin_email' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_kin_phone' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_kin_relationship' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_bank_id' => [
                    'type' => 'INT'
                ],

                'cooperator_account_number' => [
                    'type' => 'TEXT'
                ],

                'cooperator_bank_branch' => [
                    'type' => 'TEXT'
                ],

                'cooperator_sort_code' => [
                    'type' => 'TEXT'
                ],

                'cooperator_date' =>[
                    'type' => 'date',
                ],

                'cooperator_savings' =>[
                    'type' => 'DOUBLE',
                ],

                'cooperator_verify_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'cooperator_verify_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],

                'cooperator_verify_comment' =>[
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_approved_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'cooperator_approved_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],

                'cooperator_approved_comment' =>[
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'cooperator_discarded_by' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'cooperator_discarded_date' => [
                    'type' => 'date',
                    'null' => 'true'
                ],
                'cooperator_discarded_reason' => [
                    'type' => 'TEXT',
                    'null' => 'true'

                ],

                'cooperator_status' =>[
                    'type' => 'INT',
                ],

            ]
        );
        $this->forge->addKey('cooperator_id', true);
        $this->forge->addUniqueKey(['cooperator_staff_id', 'cooperator_email', 'cooperator_telephone']);
        $this->forge->createTable('cooperators');
    }

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
