<?php


namespace App\Models;


class PaymentsModel extends \CodeIgniter\Model
{
    protected $table = 'payments';
    protected $primaryKey = 'payment_id';

    protected $allowedFields = [
        'payment_id',  'payment_staff_id', 'payment_amount', 'payment_contribution_type_id', 'payment_type', 'payment_narration',
        'payment_date', 'payment_reference_code', 'payment_action_by' ];
}
