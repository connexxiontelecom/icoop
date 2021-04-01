<?php 
namespace App\Models;
use CodeIgniter\Model;

class LoanApplicationModel extends Model{
    protected $table = 'loan_applications';
    protected $primaryKey = 'loan_app_id';
    protected $allowedFields = ['staff_id', 'name', 'loan_type', 'duration', 'amount', 'loan_terms', 'guarantor', 'guarantor_2', 'verified_by',
                                'verify_date', 'approved_by', 'approve_date', 'verify', 'approve', 'applied_date', 'applied_by',
                            'verify_comment', 'approve_comment', 'decline_comment', 'unverify_comment', 'attachment','encumbrance_amount'];



    public function getLoanVerification(){
        $builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->where('loan_applications.verify = 0');
        $builder->groupby('loan_applications.loan_app_id');
        return $builder->get()->getResultObject();
    }
    public function getLoanApplicationDetail($id){
        $builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
        $builder->where('loan_applications.loan_app_id = '.$id);
        return $builder->get()->getRowObject();
    }
    public function getGuarantorOne($id){
        $builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.guarantor');
        $builder->where('loan_applications.loan_app_id = '.$id);
        return $builder->get()->getRowObject();
    }
    public function getGuarantorTwo($id){
        $builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.guarantor_2');
        $builder->where('loan_applications.loan_app_id = '.$id);
        return $builder->get()->getRowObject();
    }

    public function getLoanApproval(){
        $builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->where('loan_applications.verify = 1');
        $builder->where('loan_applications.approve = 0');
        $builder->groupby('loan_applications.loan_app_id');
        return $builder->get()->getResultObject();
    }

    public function getAllLoanApplications(){
		$builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
		$builder->orderBy('loan_applications.applied_date', 'DESC');
        return $builder->get()->getResultObject();
	}
    public function getAllApprovedLoanApplications(){
		$builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->where('loan_applications.approve = 1');
		$builder->orderBy('loan_applications.applied_date', 'DESC');
        return $builder->get()->getResultObject();
	}
    public function getAllDisapprovedLoanApplications(){
		$builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->where('loan_applications.disapproved = 1');
		$builder->orderBy('loan_applications.applied_date', 'DESC');
        return $builder->get()->getResultObject();
	}
    public function getApprovedLoanApplicationReport($from,$to){
		$builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->where('loan_applications.approve = 1');
         $builder->where('loan_applications.approve_date >= ', $from);
		$builder->where('loan_applications.approve_date <= ', $to);
		$builder->orderBy('loan_applications.applied_date', 'DESC');
        return $builder->get()->getResultObject();
	}

    public function getDisapprovedLoanApplicationReport($from,$to){
		$builder = $this->db->table('loan_applications');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = loan_applications.staff_id');
        $builder->join('loan_setups', 'loan_setups.loan_setup_id = loan_applications.loan_type');
        $builder->where('loan_applications.disapproved = 1');
         $builder->where('loan_applications.approve_date >= ', $from);
		$builder->where('loan_applications.approve_date <= ', $to);
		$builder->orderBy('loan_applications.applied_date', 'DESC');
        return $builder->get()->getResultObject();
	}
}

?>