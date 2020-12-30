<?php 
namespace App\Models;
use CodeIgniter\Model;

class CoaModel extends Model{
    protected $table = 'coas';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'user_type', 'created_at'];
}

?>