<?php


namespace App\Models;


class Banks extends \CodeIgniter\Model
{
    protected $table = 'banks';
    protected $allowedFields = ['bank_id','bank_name'];
}
