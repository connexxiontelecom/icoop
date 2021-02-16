<?php 
namespace App\Models;
use CodeIgniter\Model;

class ThirdPartyPaymentEntryModel extends Model{
    protected $table = 'third_party_payment_entries';
    protected $primaryKey = 'third_party_payment_entry_id';
    protected $allowedFields = ['third_party_payment_entry_id', 'entry_payment_date', 'entry_bank_id', 
    'entry_amount', 'entry_gl_account_no','entry_reference_no', 'entry_narration', 'entry_payee_name', 
    'entry_payee_bank','entry_bank_account_no','entry_sort_code','cart'];


    
     public function getEntries(){
        $builder = $this->db->table('third_party_payment_entries');
        $builder->join('banks', 'banks.bank_id = third_party_payment_entries.entry_bank_id');
       // $builder->join('schedule_master_details', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
        //$builder->join('cooperators', 'cooperators.cooperator_staff_id = schedule_master_details.coop_id');
        $builder->join('coop_banks', 'coop_banks.coop_bank_id = third_party_payment_entries.entry_bank_id');
        $builder->where('third_party_payment_entries.cart =  0');
        return $builder->get()->getResultObject();
    } 

}

?>