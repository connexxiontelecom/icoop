<?php 
namespace App\Models;
use CodeIgniter\Model;

class CustomerReceivableModel extends Model{
    protected $table = 'customer_receivables';
    protected $primaryKey = 'customer_receivable_id';
    protected $allowedFields = ['customer_receivable_id', 'cr_transaction_date', 'cr_coop_bank_id', 
    'cr_amount', 'cr_purpose','cr_gl_cr', 'cr_customer_setup_id', 'cr_verify', 
    'cr_approve','cr_approved_by','cr_verified_by','cr_date_approved', 'cr_approve_comment'];


     public function getUnverifiedReceivables(){
            $builder = $this->db->table('customer_receivables');
            $builder->join('coop_banks', 'customer_receivables.cr_coop_bank_id = coop_banks.coop_bank_id');
            $builder->join('coas', 'coas.glcode = coop_banks.glcode');
            $builder->join('customer_setups', 'customer_receivables.cr_customer_setup_id = customer_setups.customer_setup_id');
            $builder->where('customer_receivables.cr_verify = 0');
            return $builder->get()->getResultObject();
     }
     public function getVerifiedReceivables(){
            $builder = $this->db->table('customer_receivables');
            $builder->join('coop_banks', 'customer_receivables.cr_coop_bank_id = coop_banks.coop_bank_id');
            $builder->join('coas', 'coas.glcode = coop_banks.glcode');
            $builder->join('customer_setups', 'customer_receivables.cr_customer_setup_id = customer_setups.customer_setup_id');
            $builder->where('customer_receivables.cr_verify = 1');
            $builder->where('customer_receivables.cr_approve = 0');
            return $builder->get()->getResultObject();
     }

      public function getCustomer($id){
        $builder = $this->db->table('customer_receivables');
        $builder->where('cr_customer_setup_id = '.$id);
        return $builder->get()->getRowObject();
    }


    public function generateThirdPartyReport($from, $to){
        $builder = $this->db->table('customer_receivables');
        $builder->join('coop_banks', 'customer_receivables.cr_coop_bank_id = coop_banks.coop_bank_id');
        $builder->join('coas', 'coas.glcode = coop_banks.glcode');
        $builder->join('customer_setups', 'customer_receivables.cr_customer_setup_id = customer_setups.customer_setup_id');
        $builder->where('customer_receivables.cr_approve = 1');
        $builder->where('customer_receivables.cr_date_approved >= ', $from);
        $builder->where('customer_receivables.cr_date_approved <= ', $to);
        return $builder->get()->getResultObject();
    }

    public function getThirdpartyReceiptById($receivable_id){
        $builder = $this->db->table('customer_receivables');
        $builder->join('coop_banks', 'customer_receivables.cr_coop_bank_id = coop_banks.coop_bank_id');
        $builder->join('coas', 'coas.glcode = coop_banks.glcode');
        $builder->join('customer_setups', 'customer_receivables.cr_customer_setup_id = customer_setups.customer_setup_id');
        $builder->where('customer_receivables.customer_receivable_id = '.$receivable_id);
        return $builder->get()->getRowObject();
    }

}

?>