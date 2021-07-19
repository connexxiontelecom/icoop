<?php 
namespace App\Models;
use CodeIgniter\Model;

class ThirdPartyPaymentEntryModel extends Model{
    protected $table = 'third_party_payment_entries';
    protected $primaryKey = 'third_party_payment_entry_id';
    protected $allowedFields = ['third_party_payment_entry_id', 'entry_payment_date', 'entry_bank_id', 
    'entry_amount', 'entry_gl_account_no','entry_reference_no', 'entry_narration', 'entry_payee_name', 
    'entry_payee_bank','entry_bank_account_no','entry_sort_code','cart', 'entry_attachment', 'entry_verified',
    'entry_date_verified','entry_verified_by'
];


    
     public function getEntries(){
        $builder = $this->db->table('third_party_payment_entries');
        $builder->join('banks', 'banks.bank_id = third_party_payment_entries.entry_payee_bank');
       // $builder->join('schedule_master_details', 'schedule_master_details.schedule_master_id = schedule_masters.schedule_master_id');
//        $builder->join('coop_banks', 'coop_banks.bank_id = banks.bank_id');
        $builder->join('coas', 'coas.glcode = third_party_payment_entries.entry_gl_account_no');
        //$builder->groupBy('coop_banks.bank_id');
        $builder->where('third_party_payment_entries.cart =  0');
        return $builder->get()->getResultObject();
    } 
     public function getLastRecord(){
        /*  $this->db->select("*");
        $this->db->from("table name");
        $this->db->limit(1);
        $this->db->order_by('id',"DESC");
        $query = $this->db->get();
        $result = $query->result(); */

        /* $this->db->table('third_party_payment_entries');
        $this->db->limit(1);
        $this->db->order_by('third_party_payment_entry_id', 'DESC');
        $query = $this->db->get();
        $result = $query->getRowObject(); */
    } 
     public function getThirdpartyEntry($id){
        $builder = $this->db->table('third_party_payment_entries');
        $builder->join('banks', 'banks.bank_id = third_party_payment_entries.entry_bank_id');
        $builder->join('coop_banks', 'coop_banks.bank_id = banks.bank_id');
        $builder->join('coas', 'coas.glcode = third_party_payment_entries.entry_gl_account_no');
        $builder->groupBy('coop_banks.bank_id');
        $builder->where('third_party_payment_entries.third_party_payment_entry_id = '.$id);
        return $builder->get()->getRowObject();
    } 

}

?>
