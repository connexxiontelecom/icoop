<?php 
namespace App\Models;
use CodeIgniter\Model;

class EntryPaymentMasterModel extends Model{
    protected $table = 'entry_payment_masters';
    protected $primaryKey = 'entry_payment_master_id';
    protected $allowedFields = ['entry_payment_bank_id', 'entry_payment_payable_date', 'entry_payment_cheque_no',
    'entry_payment_verified', 'entry_payment_amount', 'entry_payment_verified_by', 'entry_payment_date_verified',
    'entry_payment_approved','entry_payment_approved_by','entry_payment_approved_date'];

    


    public function getEntryMaster(){
        $builder = $this->db->table('entry_payment_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = entry_payment_masters.entry_payment_bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('entry_payment_masters.entry_payment_verified = 0');
        return $builder->get()->getResultObject();
    }
    public function getVerifiedEntryMaster(){
        $builder = $this->db->table('entry_payment_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = entry_payment_masters.entry_payment_bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('entry_payment_masters.entry_payment_verified = 1');
        $builder->where('entry_payment_masters.entry_payment_approved = 0');
        return $builder->get()->getResultObject();
    }

    public function getEntryMasterById($id){
        $builder = $this->db->table('entry_payment_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = entry_payment_masters.entry_payment_bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('entry_payment_masters.entry_payment_master_id = '.$id);
        return $builder->get()->getRowObject();
    }
   
    /*public function getVerifiedScheduleMaster(){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('schedule_masters.verified = 1');
        $builder->where('schedule_masters.approved = 0');
        return $builder->get()->getResultObject();
    }
 */
    
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