<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanApplicationModel extends Model{
    protected $table = 'loan_applications';
    protected $allowedFields = ['staff_id', 'name', 'loan_type', 'duration', 'amount', 'loan_terms', 'guarantor', 'verified_by',
                                'verify_date', 'approved_by', 'approve_date', 'verify', 'approve', 'applied_date', 'applied_by'];

}

?>