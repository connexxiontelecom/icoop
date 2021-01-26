<?php


namespace App\Models;


class WithdrawModel extends \CodeIgniter\Model
{
    protected $table = 'withdraws';
    protected $allowedFields = ['withdraw_id',

        'withdraw_staff_id',

        'withdraw_ct_id',

        'withdraw_amount',

        'withdraw_date',

        'withdraw_verify_by',

        'withdraw_verify_comment',

        'withdraw_verify_date',

        'withdraw_approved_by',

        'withdraw_approved_date',

        'withdraw_approved_comment',

        'withdraw_discarded_by',

        'withdraw_discarded_date',

        'withdraw_discarded_comment',];


}
