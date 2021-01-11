<?php


namespace App\Models;


class Banks extends \CodeIgniter\Model
{
    protected $table = 'banks';
    protected $primaryKey = 'bank_id';
    protected $allowedFields = ['bank_id','bank_name', 'sort_code'];
}
