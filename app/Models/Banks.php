<?php


namespace App\Models;


class Banks extends \CodeIgniter\Model
{
    protected $table = 'banks';
    protected $primaryKey = 'bank_id';
    protected $allowedFields = ['bank_id','bank_name', 'sort_code'];


    public function getBanks(){
        $builder = $this->db->table('banks');
        /* $builder->join('banks', 'coop_banks.bank_id = banks.bank_id');
        $builder->join('coas', 'coas.glcode = coop_banks.glcode');
        $builder->groupby('coop_banks.coop_bank_id'); */
        return $builder->get()->getResultObject();
    }
}
