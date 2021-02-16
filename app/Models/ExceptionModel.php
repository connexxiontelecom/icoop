<?php


namespace App\Models;


class ExceptionModel extends \CodeIgniter\Model
{
    protected $table = 'exceptions';
    protected $primaryKey = 'exception_id';
    protected $allowedFields = ['exception_id',	'exception_staff_id', 'exception_staff_name', 'exception_transaction_date', 'exception_amount',	'exception_ref_code', 'exception_month', 'exception_year',];

}
