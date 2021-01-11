<?php 
namespace App\Models;
use CodeIgniter\Model;

class LocationModel extends Model{
    protected $table = 'locations';
    protected $primaryKey = 'location_id';
    protected $allowedFields = ['location_name'];
}

?>