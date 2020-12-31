<?php 
namespace App\Models;
use CodeIgniter\Model;

class JournalVoucherModel extends Model{
    protected $table = 'journal_vouchers';
    protected $primaryKey = 'journal_id';
    protected $allowedFields = ['entry_by', 'narration', 'name', 'glcode', 'dr_amount', 'cr_amount', 'ref_no', 'jv_date', 'entry_date', 'posted', 'posted_date', 'trash', 'created_at'];

}

?>