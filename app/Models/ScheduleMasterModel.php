<?php 
namespace App\Models;
use CodeIgniter\Model;

class ScheduleMasterModel extends Model{
    protected $table = 'schedule_masters';
    protected $primaryKey = 'schedule_master_id';
    protected $allowedFields = ['bank_id', 'payable_date', 'creation_date'];




    public function getScheduleMaster(){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        return $builder->get()->getResultObject();
    }


    public function getSchedulePaymentDetail($id){
        $builder = $this->db->table('schedule_masters');
        $builder->join('banks', 'banks.bank_id = schedule_masters.bank_id');
        $builder->join('schedule_master_details', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = schedule_master_details.coop_id');
        $builder->join('coop_banks', 'coop_banks.bank_id = banks.bank_id');
        $builder->join('loans', 'loans.staff_id = cooperators.cooperator_staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loans.loan_type');
        $builder->join('loan_applications', 'loan_applications.loan_app_id = loans.loan_app_id');
        $builder->where('schedule_masters.schedule_master_id = '.$id);
        return $builder->get()->getRowObject();
    }
/*     public function getPayableDetails($id){
        $builder = $this->db->table('schedule_masters');
        $builder->join('banks', 'banks.bank_id = schedule_masters.bank_id');
        $builder->join('schedule_master_details', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = schedule_master_details.coop_id');
        $builder->join('coop_banks', 'coop_banks.bank_id = banks.bank_id');
        $builder->where('schedule_masters.schedule_master_id = '.$id);
        return $builder->get()->getRowObject();
    } */

}

?>