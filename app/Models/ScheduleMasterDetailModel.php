<?php 
namespace App\Models;
use CodeIgniter\Model;

class ScheduleMasterDetailModel extends Model{
    protected $table = 'schedule_master_details';
    protected $primaryKey = 'schedule_master_detail_id';
    protected $allowedFields = ['schedule_master_detail_id', 'coop_id', 'amount', 'loan_type', 'loan_id', 'schedule_master_id'];

    
    public function get_payment_schedules(){
        
        $builder = $this->db->table('schedule_masters');
        $builder->join('schedule_master_details', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
        //$builder->where('disburse')
        return $builder->get()->getResultObject();
      
    }

   

}

?>