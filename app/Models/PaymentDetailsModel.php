<?php


namespace App\Models;


class PaymentDetailsModel extends \CodeIgniter\Model
{
    protected $table = 'payment_details';
    protected $primaryKey = 'pd_id';
    protected $allowedFields = ['pd_id', 'pd_staff_id',	'pd_transaction_date',	'pd_narration', 'pd_amount', 'pd_drcrtype', 'pd_ct_id', 'pd_pg_id', 'pd_ref_code'];
}
