<?php 
namespace App\Models;
use CodeIgniter\Model;

class CoopBankModel extends Model{
    protected $table = 'coop_banks';
    protected $primaryKey = 'coop_bank_id';
    protected $allowedFields = ['bank_id','branch', 'account_no', 'description', 'glcode', 'created_at'];

    public function getCoopBanks(){
        $builder = $this->db->table('coop_banks');
        $builder->join('banks', 'coop_banks.bank_id = banks.bank_id');
        $builder->join('coas', 'coas.glcode = coop_banks.glcode');
       // $builder->groupby('coop_banks.coop_bank_id');
        return $builder->get()->getResultObject();
    }
    public function getBank($id){
        $builder = $this->db->table('coop_banks');
        $builder->where('coop_bank_id = '.$id);
        return $builder->get()->getRowObject();
    }
    
    public function getCoopBank($id){
	    $builder = $this->db->table('coop_banks');
	    $builder->join('banks', 'coop_banks.bank_id = banks.bank_id');
	    $builder->join('coas', 'coas.glcode = coop_banks.glcode');
	    $builder->where('coop_banks.coop_bank_id', $id);
	    return $builder->get()->getRowObject();
    }
}

?>
