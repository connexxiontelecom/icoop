<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoanSetupsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'loan_setup_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'loan_description' =>[
					'type' => 'TEXT',
					'null'=>true,
					'default'=>'iCoop'
				],

				'age_qualification' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>'1'
				],
				'psr' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>0,
					'comment'=>'0=no,1=yes'
				],
				'psr_value' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'min_credit_limit' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'max_credit_limit' =>[
					'type' => 'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				'max_repayment_periods' =>[
					'type' => 'INT',
					'null'=>true,
					'default'=>1
				],
				'interest_rate'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'interest_method'=>[
					'type'=>'INT',
					'null'=>true,
					'comment'=>'1=Flat, 2=monthly, 3=yearly'
				],
				'commitment'=>[
					'type'=>'INT',
					'default'=>0,
					'comment'=>'0=no, 1=yes'
				],
				'commitment_value'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'loan_gl_account_no'=>[
					'type'=>'INT',
					'null'=>true
				],
				'loan_unearned_int_gl_account_no'=>[
					'type'=>'INT',
					'null'=>true
				],
				'loan_int_income_gl_account_no'=>[
					'type'=>'INT',
					'null'=>true
				],
				'loan_terms'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'status'=>[
					'type'=>'INT',
					'null'=>true,
					'default'=>0
				],
				'payable'=>[
					'type'=>'INT',
					'null'=>true,
					'default'=>0
				],
				'created_at'=>[
					'type'=>'DATETIME',
					'null'=>true
				]



			]
		);
		$this->forge->addKey('loan_setup_id', true);
		$this->forge->createTable('loan_setups');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
