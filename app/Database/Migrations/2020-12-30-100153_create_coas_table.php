<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCoasTable extends Migration
{
	public function up()
	{
		 //
		 $this->db->disableForeignKeyChecks();

		 $this->forge->addField(
			 [
				 'coa_id' =>[
					 'type' => 'INT',
					 'constraint' => 11,
					 'auto_increment' => true,
				 ],
 
				 'account_name' =>[
					 'type' => 'TEXT',
				 ],
				 'account_type' =>[
					 'type' => 'INT',
				 ],
				 'bank' => [
					 'type'=>'INT',
					 'default'=>0
				 ],
				 'glcode'=>[
					 'type'=>'INT'
				 ],
				 'parent_account'=>[
					 'type'=>'INT',
					 'default'=>0
				 ],
				 'type'=>[
					 'type'=>'TEXT',
					 'null'=>true,
					 'comment'=>'0=General, 1=Detail'
				 ],
				 'created_at'=>[
					 'type'=>'TEXT',
					 'default'=>'CURRENT_TIMESTAMP'
				 ],
				 'note'=>[
					 'type'=>'TEXT',
					 'null'=>true
				 ]
 
 
 
			 ]
		 );
		 $this->forge->addKey('coa_id', true);
		 $this->forge->addUniqueKey(['account_name']);
		 $this->forge->createTable('coas');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		//
	}
}
