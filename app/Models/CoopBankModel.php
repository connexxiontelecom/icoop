<?php 
namespace App\Models;
use CodeIgniter\Model;

class CoopBankModel extends Model{
    protected $table = 'coop_banks';
    protected $allowedFields = ['bank_id','branch', 'account_no', 'description', 'glcode', 'created_at'];
}

?>