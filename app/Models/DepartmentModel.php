<?php 
namespace App\Models;
use CodeIgniter\Model;

class DepartmentModel extends Model{
    protected $table = 'departments';
    protected $allowedFields = ['department_name','created_at'];
}

?>