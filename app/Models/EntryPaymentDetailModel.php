<?php 
namespace App\Models;
use CodeIgniter\Model;

class EntryPaymentDetailModel extends Model{
    protected $table = 'entry_payment_details';
    protected $primaryKey = 'entry_payment_d_detail_id';
    protected $allowedFields = ['entry_payment_d_master_id', 'entry_payment_d_payee_bank', 'entry_payment_d_payee_name',
    'entry_payment_d_amount', 'entry_payment_d_bank_name', 'entry_payment_d_account_no', 'entry_payment_d_reference_no',
    'entry_payment_d_gl_account_no', 'third_party_payment_entry_id'];

    

    public function getEntryDetailById($id){
        $builder = $this->db->table('entry_payment_details');
        $builder->join('entry_payment_masters', 'entry_payment_details.entry_payment_d_master_id = entry_payment_masters.entry_payment_master_id');
        $builder->join('banks', 'banks.bank_id = entry_payment_details.entry_payment_d_payee_bank');
        $builder->join('third_party_payment_entries', 'third_party_payment_entries.third_party_payment_entry_id = entry_payment_details.third_party_payment_entry_id');
        //$builder->groupBy('banks.bank_id');
        $builder->where('entry_payment_details.entry_payment_d_master_id = '.$id);
        return $builder->get()->getResultObject();
    }
    public function getPaymentDetailsByMasterId($id){
        $builder = $this->db->table('entry_payment_details');
        $builder->where('entry_payment_details.entry_payment_d_master_id = '.$id);
        return $builder->get()->getResultObject();
    }
    public function getPaymentDetailsByDetailId($id){
        $builder = $this->db->table('entry_payment_details');
        $builder->where('entry_payment_details.entry_payment_d_detail_id', $id);
        return $builder->get()->getResultObject();
    }
    /* public function getScheduleMaster(){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('schedule_masters.verified = 0');
        $builder->groupby('schedule_masters.schedule_master_id');
        return $builder->get()->getResultObject();
    }

    public function getVerifiedScheduleMaster(){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('schedule_masters.verified = 1');
        $builder->where('schedule_masters.approved = 0');
        return $builder->get()->getResultObject();
    }
    public function getScheduleMasterItem($id){
        $builder = $this->db->table('schedule_masters');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = schedule_masters.bank_id');
        $builder->join('banks', 'banks.bank_id = coop_banks.bank_id');
        $builder->where('schedule_masters.schedule_master_id = '.$id);
        return $builder->get()->getRowObject();
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
