<?php 
namespace App\Models;
use CodeIgniter\Model;

class CoaModel extends Model{
    protected $table = 'coas';
    protected $allowedFields = ['account_name', 'account_type', 'bank', 'glcode', 'parent_account', 'type', 'created_at'];


    

    public function getCoopBanks(){
        $builder = $this->db->table('banks');
        $builder->join('coop_banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->join('coas', 'coas.glcode = coop_banks.glcode');
        $builder->where('coas.type = 1'); //detail account
        return $builder->get()->getResultObject();
    }

}

?>