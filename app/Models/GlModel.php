<?php 
namespace App\Models;
use CodeIgniter\Model;

class GlModel extends Model{
    protected $table = 'gls';
    protected $primaryKey = 'gl_id';
    protected $allowedFields = ['glcode', 'narration', 'posted_by', 'dr_amount', 'cr_amount', 'ref_no', 'bank', 'ob', 'created_at'];

}

?>