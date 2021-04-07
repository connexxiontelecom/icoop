<?php


namespace App\Models;
//1 = CREDIT, 2 = DEBIT

/***
 * payment types
 * 1 = withdraw
 * 2 = withdraw charges
 * 3 = payroll contribution
 * 4 = journal transfer
 * 5 = external savings
 * 6 = reconciliation
 * 7 = account closure
 *
 */


class PaymentDetailsModel extends \CodeIgniter\Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'pd_id';
    protected $allowedFields = ['pd_id', 'pd_staff_id',	'pd_transaction_date',	'pd_narration', 'pd_amount', 'pd_payment_type', 'pd_drcrtype', 'pd_ct_id', 'pd_pg_id', 'pd_ref_code', 'pd_month', 'pd_year'];

    public function get_payment_staff_id($staff_id){
        $builder = $this->db->table('payment_details');
//        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
//        $builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
//        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
//        $builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
        //$builder->join('contribution_type', 'contribution_type.contribution_type_id = payment_details.pd_ct_id');
        $builder->groupBy('payment_details.pd_ct_id');
        $builder->where('payment_details.pd_staff_id', $staff_id);
        return $builder->get()->getResultObject();
    }
    public function getStaffPaymentDetails($staff_id){
        $builder = $this->db->table('payment_details');
        $builder->join('contribution_type', 'contribution_type.contribution_type_id = payment_details.pd_ct_id');
        $builder->groupBy('payment_details.pd_ct_id');
        $builder->where('payment_details.pd_staff_id', $staff_id);
        return $builder->get()->getResultObject();
    }

    public function get_year_pd($staff_id){


       // $builder = $this->db->table('payment_details');

        $builder = $this->db->query("select year(pd_transaction_date) as year from payment_details where pd_staff_id = '$staff_id' group by year(pd_transaction_date)");
//        $builder->query('');
//
//        $builder->distinct("DATE_FORMAT(pd_transaction_date,'%Y')");
//        $builder->select();


       // $builder->like('pd_transaction_date', '2020', 'both');
//        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
//        $builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
//        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
//        $builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
        //$builder->join('contribution_type', 'contribution_type.contribution_type_id = payment_details.pd_ct_id');
//        $builder->groupBy('payment_details.pd_ct_id');
//        $builder->where('payment_details.pd_staff_id', $staff_id);
        return $builder->getResultArray();
    }

    public function get_contribution_ledger_past_year($staff_id, $ct_id, $year){
        $builder = $this->db->table('payment_details');
        $builder->where(['pd_staff_id' => $staff_id, 'pd_ct_id' => $ct_id]);
        $builder->where('year(pd_transaction_date) <', $year);

        //$builder = $this->db->query("select * from payment_details where pd_staff_id = '$staff_id', pd_ct_id = '$ct_id', date('Y', strtotime('pd_transaction_date')) = '$year'");
        return $builder->get()->getResultObject();
    }
	
	
	public function get_regular_savings($staff_id){
		$builder = $this->db->table('payment_details');
		$builder->join('contribution_type', 'contribution_type.contribution_type_id = payment_details.pd_ct_id');
		$builder->where('payment_details.pd_staff_id', $staff_id);
		$builder->where('contribution_type.contribution_type_regular', 1);
		return $builder->get()->getResultObject();
	}
	
	public function get_payments_group($ct_id){
		$builder = $this->db->table('payment_details');
		$builder->groupBy('payment_details.pd_staff_id');
		$builder->where('payment_details.pd_ct_id', $ct_id);
		return $builder->get()->getResultArray();
	}
	
	public function get_payments($ct_id){
		$builder = $this->db->table('payment_details');
		$builder->where('payment_details.pd_ct_id', $ct_id);
		return $builder->get()->getResultArray();
	}
	
	public function get_payment_bf($staff_id, $ct_id, $bf_date){
		$builder = $this->db->table('payment_details');
		$builder->where('payment_details.pd_staff_id', $staff_id);
		$builder->where('payment_details.pd_ct_id', $ct_id);
		$builder->where('payment_details.pd_transaction_date <', $bf_date);
		return $builder->get()->getResultArray();
	}
	
	public function get_payments_range($staff_id, $ct_id, $from, $to){
		$builder = $this->db->table('payment_details');
		$builder->where('payment_details.pd_staff_id', $staff_id);
		$builder->where('payment_details.pd_ct_id', $ct_id);
		$builder->where('payment_details.pd_transaction_date >=', $from);
		$builder->where('payment_details.pd_transaction_date <=', $to);
		return $builder->get()->getResultArray();
	}

}
