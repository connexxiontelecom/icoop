<?php 
namespace App\Models;
use CodeIgniter\Model;

class GlModel extends Model{
    protected $table = 'gls';
    protected $primaryKey = 'gl_id';
    protected $allowedFields = ['glcode', 'narration', 'posted_by', 'dr_amount', 'cr_amount', 'ref_no', 'bank', 'ob', 'created_at'];



    public function getFirstTransaction(){
        $builder = $this->db->table('gls');
		$builder->orderBy('gl_id', 'DESC');
		return $builder->get()->getRowArray();
    }

    public function sjs (){
        $builder = $this->db->table('gls');
		$builder->where('gls.pd_staff_id', $staff_id);
		$builder->where('payment_details.pd_ct_id', $ct_id);
		$builder->where('payment_details.pd_transaction_date <', $bf_date);
		return $builder->get()->getResultArray();

        DB::table(Auth::user()->tenant_id.'_gl')->whereBetween('created_at', [$inception->created_at, $current->parse($request->from)->subDays(1)])->sum('dr_amount');
    }
}

?>