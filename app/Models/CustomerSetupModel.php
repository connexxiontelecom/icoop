<?php 
namespace App\Models;
use CodeIgniter\Model;

class CustomerSetupModel extends Model{
    protected $table = 'customer_setups';
    protected $primaryKey = 'customer_setup_id';
    protected $allowedFields = ['customer_setup_id', 'customer_name', 'contact_person', 'email', 'phone_no', 'gl_account_code'];



    public function getCustomerSetupList(){
        $builder = $this->db->table('customer_setups');
        $builder->join('coas', 'coas.glcode = customer_setups.gl_account_code');
      
        return $builder->get()->getResultObject();
    } 


    public function getCustomerDetails($id){
        $builder = $this->db->table('customer_setups');
        $builder->where('customer_setup_id = '.$id);
        return $builder->get()->getRowObject();
    }

}

?>