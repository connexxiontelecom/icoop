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

    public function getBfDr($from, $to){
        $builder = $this->db->table('gls');
        $builder->where('gls.gl_transaction_date >= ', $from);
		$builder->where('gls.gl_transaction_date <= ', $to);
        return $builder->get()->getResultObject();

    }
    public function getBfCr($from, $to){
        $builder = $this->db->table('gls');
        $builder->where('gls.gl_transaction_date >= ', $from);
		$builder->where('gls.gl_transaction_date <= ', $to);
        return $builder->get()->getResultObject();

    }

    public function getReport($from, $to){
        $builder = $this->db->table('gls')
                 ->select('gls.glcode')
                ->join('coas', 'coas.glcode = gls.glcode')
                ->selectSum('gls.dr_amount', 'sumDebit')
                ->selectSum('gls.cr_amount', 'sumCredit')
                ->select('coas.account_name', 'coas.glcode', 'coas.account_type')
                 ->where('coas.type', 1)
                ->where('gls.gl_transaction_date >= ', $from)
		        ->where('gls.gl_transaction_date <= ', $to)
                ->orderBy('coas.account_type', 'ASC')
                ->groupBy('gls.glcode');
        return $builder->get()->getResultObject();
        //return $builder->get()->getResultArray();
        /* $builder = $this->db->table('gls');
        $builder->join('coas', 'coas.glcode = gls.glcode');
        $builder->orderBy('coas.account_type', 'ASC');
        $builder->where('coas.type', 1);
        $builder->where('gls.gl_transaction_date >= ', $from);
		$builder->where('gls.gl_transaction_date <= ', $to);
        return $builder->get()->getResultObject(); */
    }
    public function getRevenue($from, $to){
        $builder = $this->db->table('gls');
        $builder->join('coas', 'coas.glcode = gls.glcode');
        $builder->orderBy('coas.account_type', 'ASC');
        $builder->where('coas.type', 1);
        $builder->where('coas.account_type', 4);
        $builder->where('gls.gl_transaction_date >= ', $from);
		$builder->where('gls.gl_transaction_date <= ', $to);
        return $builder->get()->getResultObject();
        
    }
    public function getExpenses($from, $to){
        $builder = $this->db->table('gls');
        $builder->join('coas', 'coas.glcode = gls.glcode');
        $builder->orderBy('coas.account_type', 'ASC');
        $builder->where('coas.type', 1);
        $builder->where('coas.account_type', 5);
        $builder->where('gls.gl_transaction_date >= ', $from);
		$builder->where('gls.gl_transaction_date <= ', $to);
        return $builder->get()->getResultObject();
        
    }
}

?>