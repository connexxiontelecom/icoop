<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePolicyConfigsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'policy_config_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'company_name' =>[
					'type' => 'TEXT',
					'null'=>true,
					'default'=>'iCoop'
				],

				'logo' =>[
					'type' => 'TEXT',
					'null'=>true,
					'default'=>'icoop.png'
				],
				'signature_1' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'signature_2' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'signature_3' =>[
					'type' => 'TEXT',
					'null'=>true
				],
				'minimum_saving'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'registration_fee'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'savings_interest_rate'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'savings_withdrawal_charge'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'contribution_payroll_dr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'contribution_payroll_cr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'contribution_external_dr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'withdrawal_dr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'registration_fee_dr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'registration_fee_cr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'income_savings_withdrawal_charge_dr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'income_savings_withdrawal_charge_cr'=>[
					'type'=>'INT',
					'null'=>true
				],
				'created_at'=>[
					'type'=>'DATETIME',
					'null'=>true
				]



			]
		);
		$this->forge->addKey('policy_config_id', true);
		$this->forge->createTable('policy_configs');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
