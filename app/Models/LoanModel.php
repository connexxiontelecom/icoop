<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanModel extends Model{
    protected $table = 'loans';
    protected $primaryKey = 'loan_id';
    protected $allowedFields = ['loan_app_id', 'staff_id', 'amount', 'interest_rate', 'interest', 'disburse', 'created_at'];

}

?>