<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGlsTable extends Migration
{
	public function up()
	{
		$this->db->disableForeignKeyChecks();

		$this->forge->addField(
			[
				'gl_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],

				'glcode' =>[
					'type' => 'INT',
				],
				'posted_by' =>[
					'type' => 'INT',
				],
				'narration' => [
					'type'=>'TEXT'
				],
				'dr_amount'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'cr_amount'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'ref_no'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'bank'=>[
					'type'=>'INT',
					'null'=>true
				],
				'ob'=>[
					'type'=>'DOUBLE',
					'default'=>0
				],
				'created_at'=>[
					'type'=>'TEXT',
					'default'=>'CURRENT_TIMESTAMP'
				]



			]
		);
		$this->forge->addKey('gl_id', true);
		$this->forge->createTable('gls');
	}

	

	public function down()
	{
		//
	}
}
