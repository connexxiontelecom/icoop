<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Jvupdatetrashbytrashdate extends Migration
{
	public function up()
	{
		//
		$this->db->disableForeignKeyChecks();
		$fields = [
			'trash_by' => [
				'type' => 'TEXT',
				'null'=>true,
			
			],
			
			'trash_date' => [
				'type' => 'DATE',
				'null'=>true,
			
			],
		
		
		
		
		
		
		];
		$this->forge->addColumn('journal_vouchers', $fields);
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
