<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePaymentCarts extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'payment_cart_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'payable_date' =>[
					'type' => 'DATETIME',
					'null'=>true,
				],
				'bank_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'loan_id' =>[
					'type' => 'INT',
					'null'=>true,
				],
				'created_date'=>[
					'type'=>'DATETIME',
					'null'=>true
				],
				'created_by'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'transaction_type'=>[
					'type'=>'INT',
					'null'=>true,
					'comment'=>'1=loan,2=withdraw,3=closure'
				],



			]
		);
		$this->forge->addKey('payment_cart_id', true);
		$this->forge->createTable('payment_carts');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
