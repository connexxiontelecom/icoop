<?php 
namespace App\Models;
use CodeIgniter\Model;

class JournalVoucherModel extends Model{
    protected $table = 'journal_vouchers';
    protected $primaryKey = 'journal_id';
    protected $allowedFields = ['entry_by', 'narration', 'name', 'glcode', 'dr_amount', 'cr_amount', 'ref_no', 'jv_date', 'entry_date', 'posted', 'posted_date', 'trash', 'created_at', 'trash_by', 'trash_date'];
	
	public function get_jv(){
		$builder = $this->db->table('journal_vouchers');
//        $builder->join('locations', 'locations.location_id = cooperators.cooperator_location_id');
//        $builder->join('departments', 'departments.department_id = cooperators.cooperator_department_id');
//        $builder->join('payroll_groups', 'payroll_groups.pg_id = cooperators.cooperator_payroll_group_id');
//        $builder->join('states', 'states.state_id = cooperators.cooperator_state_id');
		//$builder->join('contribution_type', 'contribution_type.contribution_type_id = payment_details.pd_ct_id');
		$builder->groupBy('ref_no');
		$builder->where('journal_vouchers.posted', 0);
		$builder->where('journal_vouchers.trash', 0);
		return $builder->get()->getResultArray();
	}
	
}



?>
