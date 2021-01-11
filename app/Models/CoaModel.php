<?php 
namespace App\Models;
use CodeIgniter\Model;

class CoaModel extends Model{
    protected $table = 'coas';
    protected $allowedFields = ['account_name', 'account_type', 'bank', 'glcode', 'parent_account', 'type', 'created_at'];

}

?>