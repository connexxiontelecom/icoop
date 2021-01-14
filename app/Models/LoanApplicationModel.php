<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanApplicationModel extends Model{
    protected $table = 'loan_applications';
    protected $primaryKey = 'loan_app_id';
    protected $allowedFields = ['staff_id', 'name', 'loan_type', 'duration', 'amount', 'loan_terms', 'guarantor', 'guarantor_2', 'verified_by',
                                'verify_date', 'approved_by', 'approve_date', 'verify', 'approve', 'applied_date', 'applied_by',
                            'verify_comment', 'approve_comment', 'decline_comment', 'unverify_comment'];

}

?>