<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSavingVariationsTable extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$this->forge->addField(
			[
				'saving_variation_id' =>[
					'type' => 'INT',
					'constraint' => 11,
					'auto_increment' => true,
				],
				
				'sv_staff_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'ct_type_id' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				'sv_month' =>[
					'type' => 'TEXT',
					'null'=>true,
				],
				
				'sv_year'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'sv_status'=>[
					'type'=>'INT',
					'null'=>true
				],
				
				'sv_applied_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'sv_date_verified'=>[
					'type'=>'DATE',
					'null'=>true
				],
				'sv_verified_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'sv_approved_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				'sv_date_approved'=>[
					'type'=>'DATE',
					'null'=>true
				],
				
				'sv_is_active'=>[
					'type'=>'TEXT',
					'null'=>true,
					'default'=>'0',
					'comment'=>'0=inactive,1=active'
				],
				'sv_discard_by'=>[
					'type'=>'TEXT',
					'null'=>true
				],
				
				'sv_discard_date'=>[
					'type'=>'DATE',
					'null'=>true
				],
				'sv_amount'=>[
					'type'=>'DOUBLE',
					'null'=>true,
					'default'=>0
				],
				
				
			]
		);
		$this->forge->addKey('saving_variation_id', true);
		$this->forge->createTable('saving_variations');
	}

	public function down()
	{
		//
	}
}
