<?php 
namespace App\Models;
use CodeIgniter\Model;

class ScheduleMasterModel extends Model{
    protected $table = 'schedule_masters';
    protected $primaryKey = 'schedule_master_id';
    protected $allowedFields = ['bank_id', 'payable_date', 'creation_date'];

}

?>