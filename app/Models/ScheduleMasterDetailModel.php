<?php 
namespace App\Models;
use CodeIgniter\Model;

class ScheduleMasterDetailModel extends Model{
    protected $table = 'schedule_master_details';
    protected $primaryKey = 'schedule_master_detail_id';
    protected $allowedFields = ['schedule_master_detail_id', 'transaction_type', 'coop_id', 'amount', 'loan_type', 'loan_id', 'schedule_master_id'];

    
    public function get_payment_schedules(){
        
        $builder = $this->db->table('schedule_masters');
        $builder->join('schedule_master_details', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
        //$builder->where('disburse')
        return $builder->get()->getResultObject();
      
    }

    public function getScheduleMasterDetail($id){
        $builder = $this->db->table('schedule_master_details');
        $builder->select('*, schedule_master_details.amount as smd_amount');
        $builder->join('schedule_masters', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
        $builder->join('banks', 'banks.bank_id = schedule_masters.bank_id');
        //$builder->join('loans', 'loans.loan_id = schedule_master_details.loan_id');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = schedule_master_details.coop_id');
        $builder->join('coop_banks', 'coop_banks.bank_id = banks.bank_id');
        //$builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type'); 
        $builder->where('schedule_master_details.schedule_master_id = '.$id);
        $builder->groupby('schedule_master_details.schedule_master_detail_id');
        return $builder->get()->getResultObject();
    }

   

}

?>
