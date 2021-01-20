<?php


namespace App\Models;


class TempPaymentsModel extends \CodeIgniter\Model
{
    protected $table = 'temp_payment_details';
    protected $primaryKey = 'temp_pd_id';
    protected $allowedFields = ['temp_pd_id', 'temp_pd_staff_id',	'temp_pd_transaction_date',	'temp_pd_narration', 'temp_pd_amount', 'temp_pd_drcrtype', 'temp_pd_ct_id', 'temp_pd_pg_id', 'temp_pd_ref_code', 'temp_pd_status'];


        public function delete_temp(){

            $builder = $this->db->table('temp_payment_details');
            $builder->emptyTable();

        }

}
