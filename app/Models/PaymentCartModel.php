<?php 
namespace App\Models;
use CodeIgniter\Model;

class PaymentCartModel extends Model{
    protected $table = 'payment_carts';
    protected $allowedFields = ['bank_id', 'payable_date', 'loan_id', 'created_date', 'created_by', 'transaction_type'];


    public function getItemsInCart(){
        $builder = $this->db->table('loans');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loans.staff_id');
        $builder->join('loan_setups', 'loans.loan_type = loan_setups.loan_setup_id');
        $builder->join('banks', 'cooperators.cooperator_bank_id = banks.bank_id');
        $builder->where('loans.cart = 1');
        return $builder->get()->getResultObject();
    }
}

?>