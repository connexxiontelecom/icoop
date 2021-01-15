<?php 
namespace App\Models;
use CodeIgniter\Model;

class ScheduleMasterDetailModel extends Model{
    protected $table = 'schedule_masters';
    protected $primaryKey = 'schedule_master_id';
    protected $allowedFields = ['schedule_master_id', 'coop_id', 'amount', 'loan_type'];

}

?>