<?php 
namespace App\Models;
use CodeIgniter\Model;

class SavingVariationsModel extends Model{
    protected $table = 'saving_variations';
    protected $primaryKey = 'saving_variation_id';
    protected $allowedFields = ['saving_variation_id','sv_staff_id','ct_type_id','sv_month','sv_year','sv_status','sv_applied_by',
                                'sv_date_verified','sv_verified_by', 'sv_approved_by', 'sv_date_approved','sv_is_active',
                            'sv_discard_by', 'sv_discard_date', 'sv_amount'];


    public function getUnverifiedSavingVariations(){
        $builder = $this->db->table('saving_variations');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = saving_variations.sv_staff_id');
        $builder->join('contribution_type', 'contribution_type.contribution_type_id = saving_variations.ct_type_id');
        $builder->where('saving_variations.sv_status = 0');
        return $builder->get()->getResultObject();
    }
    public function getVerifiedSavingVariations(){
        $builder = $this->db->table('saving_variations');
        $builder->join('cooperators', 'cooperators.cooperator_staff_id = saving_variations.sv_staff_id');
        $builder->join('contribution_type', 'contribution_type.contribution_type_id = saving_variations.ct_type_id');
        $builder->where('saving_variations.sv_status = 1');
        return $builder->get()->getResultObject();
    }
    public function getPaymentDetailsByContributionType($ct){
        $builder = $this->db->table('payment_details');
        //$builder->join('cooperators', 'cooperators.cooperator_staff_id = saving_variations.sv_staff_id');
        $builder->where('pd_ct_id = '.$ct);
        return $builder->get()->getResultObject();
    }
}

?>