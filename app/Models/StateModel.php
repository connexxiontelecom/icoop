<?php 
namespace App\Models;
use CodeIgniter\Model;

class StateModel extends Model{
    protected $table = 'states';
    protected $allowedFields = ['state_name','created_at'];
}

?>