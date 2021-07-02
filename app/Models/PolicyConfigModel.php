<?php 
namespace App\Models;
use CodeIgniter\Model;

class PolicyConfigModel extends Model{
    protected $table = 'policy_configs';
    protected $primaryKey = 'policy_config_id';
    protected $allowedFields = ['company_name', 'logo', 'signature_1', 'signature_2', 'signature_3', 
        'minimum_saving', 'registration_fee', 'savings_interest_rate', 'savings_withdrawal_charge', 'max_withdrawal_amount',
        'contribution_payroll_dr', 'contribution_payroll_cr', 'contribution_external_dr', 
        'withdrawal_dr', 'registration_fee_dr', 'registration_fee_cr', 'income_savings_withdrawal_charge_dr',
        'income_savings_withdrawal_charge_cr'];

}




