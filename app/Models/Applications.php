<?php


namespace App\Models;


class Applications extends \CodeIgniter\Model
{
    protected $table = 'applications';

    protected $allowedFields = [
        'application_id',  'application_staff_id', 'application_first_name', 'application_last_name', 'application_other_name',

        'application_department_id', 'application_location_id', 'application_payroll_group_id', 'application_dob', 'application_email',

        'application__address', 'application_city', 'application_state_id', 'application_telephone', 'application_kin_fullname', 'application_kin_address',

        'application_kin_email', 'application_kin_phone', 'application_relationship', 'application_bank_id', 'application_account_number',

        'application_bank_branch', 'application_sort_code', 'application_verify_by', 'application_verify_date', 'application_approved_by',

        'application_approved_date', 'application_discarded_by', 'application_discarded_date', 'application_discarded_reason', 'application_status'

    ];
}