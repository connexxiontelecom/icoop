<?php


namespace App\Models;


class Cooperators extends \CodeIgniter\Model
{
    protected $table = 'cooperators';
    protected $primaryKey = 'cooperator_id';

    protected $allowedFields = [
        'cooperator_id', 'cooperator_application_id',  'cooperator_staff_id', 'cooperator_username', 'cooperator_password', 'cooperator_first_name', 'cooperator_last_name', 'cooperator_other_name', 'cooperator_gender',

        'cooperator_department_id', 'cooperator_location_id', 'cooperator_payroll_group_id', 'cooperator_dob', 'cooperator_email',

        'cooperator_address', 'cooperator_city', 'cooperator_state_id', 'cooperator_telephone', 'cooperator_kin_fullname', 'cooperator_kin_address',

        'cooperator_kin_email', 'cooperator_kin_phone', 'cooperator_kin_relationship', 'cooperator_bank_id', 'cooperator_account_number',

        'cooperator_bank_branch', 'cooperator_sort_code', 'cooperator_date', 'cooperator_savings', 'cooperator_verify_by', 'cooperator_verify_date', 'cooperator_verify_comment', 'cooperator_approved_by',

        'cooperator_approved_date', 'cooperator_approved_comment', 'cooperator_discarded_by', 'cooperator_discarded_date', 'cooperator_discarded_reason', 'cooperator_status'

    ];

    public function get_cooperator($cooperator_id){
        $builder = $this->db->table('cooperators');
        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
        $builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
        $builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
        $builder->join('banks', 'banks.bank_id = cooperators.cooperator_bank_id');
        $builder->where('cooperators.cooperator_id', $cooperator_id);
        return $builder->get()->getRowObject();
    }

    public function get_cooperator_staff_id($staff_id){
        $builder = $this->db->table('cooperators');
        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
        $builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
        $builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
        $builder->join('banks', 'banks.bank_id = cooperators.cooperator_bank_id');
        $builder->where('cooperator_staff_id', $staff_id);
        return $builder->get()->getRowObject();
    }

    public function get_active_cooperators(){
        $builder = $this->db->table('cooperators');
        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
        $builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
        $builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
        $builder->join('banks', 'banks.bank_id = cooperators.cooperator_bank_id');
        $builder->where('cooperator_status', 2);
        return $builder->get()->getResultObject();
    }
    public function get_active_cooperator($id){
        $builder = $this->db->table('cooperators');
        $builder->where('cooperator_staff_id = '.$id);
        return $builder->get()->getRowObject();
    }

   public function search_cooperators($value){
        $builder = $this->db->table('cooperators');
        $builder->like('cooperator_staff_id', $value);
        $builder->orLike('cooperator_first_name', $value);
        $builder->orLike('cooperator_last_name', $value);
	   
       return $builder->get()->getResultObject();
    }
	
	public function get_cooperators(){
		$builder = $this->db->table('cooperators');
		$builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
		$builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
		$builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
		$builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
		$builder->join('banks', 'banks.bank_id = cooperators.cooperator_bank_id');
		//$builder->where('cooperator_status', 2);
		return $builder->get()->getResultObject();
	}

}
