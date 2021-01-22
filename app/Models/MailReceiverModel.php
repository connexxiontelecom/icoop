<?php 
namespace App\Models;
use CodeIgniter\Model;

class MailReceiverModel extends Model{
    protected $table = 'mail_receivers';
    protected $primaryKey = 'mail_receiver_id';
    protected $allowedFields = ['mail_id', 'mail_receiver_id'];



}

?>