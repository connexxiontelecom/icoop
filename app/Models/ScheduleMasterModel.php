<?php 
namespace App\Models;
use CodeIgniter\Model;

class ScheduleMasterModel extends Model{
    protected $table = 'schedule_masters';
    protected $primaryKey = 'schedule_master_id';
    protected $allowedFields = ['bank_id', 'payable_date', 'creation_date'];




    public function getScheduleMaster(){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.schedule_master_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        return $builder->get()->getResultObject();
    }


    public function getSchedulePaymentDetail($id){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.schedule_master_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('schedule_masters.schedule_master_id = '.$id);
        return $builder->get()->getResultObject();
    }

}

?>