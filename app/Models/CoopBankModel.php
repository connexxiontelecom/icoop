<?php 
namespace App\Models;
use CodeIgniter\Model;

class CoopBankModel extends Model{
    protected $table = 'coop_banks';
    protected $allowedFields = ['bank_id','branch', 'account_no', 'description', 'glcode', 'created_at'];

    public function getCoopBanks(){
        $builder = $this->db->table('coop_banks');
        $builder->join('banks', 'coop_banks.bank_id = banks.bank_id');
        return $builder->get()->getResultObject();
    }
}

?>