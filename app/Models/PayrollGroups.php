<?php


namespace App\Models;


class PayrollGroups extends \CodeIgniter\Model
{
    protected $table = 'payroll_groups';
    protected $primaryKey = 'pg_id';
    protected $allowedFields = ['pg_id','pg_name', 'pg_gl_code'];
}
