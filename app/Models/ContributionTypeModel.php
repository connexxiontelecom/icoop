<?php


namespace App\Models;


class ContributionTypeModel extends \CodeIgniter\Model
{

    protected $table = 'contribution_type';
    protected $primaryKey = 'contribution_type_id';

    protected $allowedFields = [
        'contribution_type_id',  'contribution_type_name', 'contribution_type_glcode'];
}
