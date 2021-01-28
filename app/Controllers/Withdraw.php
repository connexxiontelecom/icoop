<?php


namespace App\Controllers;
use App\Models\PayrollGroups;
use App\Models\ContributionTypeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use App\Models\Cooperators;
use App\Models\TempPaymentsModel;
Use App\Models\PaymentDetailsModel;
use App\Models\ExceptionModel;
use App\Models\WithdrawModel;

class Withdraw extends BaseController
{
    public function __construct(){
        $this->pg = new PayrollGroups();
        $this->contribution_type = new ContributionTypeModel();
        $this->cooperator = new Cooperators();
        $this->temp_pd = new TempPaymentsModel();
        $this->pd = new PaymentDetailsModel();
        $this->exception = new ExceptionModel();
        $this->withdraw = new WithdrawModel();

    }

    public function new_withdraw(){
        $method = $this->request->getMethod();

        if($method == 'get'):


            $data['cts'] = $this->contribution_type->findAll();
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/withdraw/new_withdraw', $data);

        endif;

        if($method == 'post'):

            $withdraw_balance = $_POST['withdraw_balance'];
            $withdraw_amount = $_POST['withdraw_amount'];

            if($withdraw_amount > $withdraw_balance):
                $data = array(
                    'msg' => 'Insufficient Balance',
                    'type' => 'error',
                    'location' => base_url('new_withdraw')

                );

                return view('pages/sweet-alert', $data);


                else:

                    unset($_POST['withdraw_balance']);
                    $_POST['withdraw_status'] = 0;
                    $withdraw_staff_id = $_POST['withdraw_staff_id'];
                    $withdraw_staff_id = substr($withdraw_staff_id, 0, strpos($withdraw_staff_id, ','));
                    $_POST['withdraw_staff_id'] = $withdraw_staff_id;
                    $v =  $this->withdraw->save($_POST);

                    if($v):

                        $data = array(
                            'msg' => 'Action Successful',
                            'type' => 'success',
                            'location' => base_url('new_withdraw')

                        );
                        return view('pages/sweet-alert', $data);

                    else:
                        $data = array(
                            'msg' => 'An Error Occured',
                            'type' => 'error',
                            'location' => base_url('new_withdraw')

                        );
                        return view('pages/sweet-alert', $data);


                    endif;

                    endif;








//            $data['cts'] = $this->contribution_type->findAll();
//            $username = $this->session->user_username;
//            $this->authenticate_user($username, 'pages/withdraw/new_withdraw', $data);

        endif;
    }

    public function search_cooperator()
    {
        $value = $_GET['term'];
        if(empty($value)){
            redirect('home/error_404');
        }
        else {
            $cooperators = $this->cooperator->search_cooperators($value);
            foreach ($cooperators as $cooperator) {
                $data[] = $cooperator->cooperator_staff_id . ', ' . $cooperator->cooperator_first_name . ' ' . $cooperator->cooperator_last_name;

            }
            echo json_encode($data);
            die;
        }
    }

    public function compute_balance(){

        $staff_id = $_POST['staff_id'];
        $ct_id = $_POST['ct_id'];

       $ledgers =  $this->pd->where(['pd_staff_id' => $staff_id, 'pd_ct_id' => $ct_id])
//                        ->orderBy('pd_transaction_date', 'DESC')
            ->findAll();

        $bf = 0;

        if(!empty($ledgers)):

          foreach ($ledgers as $ledger):
                if($ledger['pd_drcrtype'] == 2):
                    $dr = $ledger['pd_amount'];
                    $cr = 0;

                  endif;
                      if($ledger['pd_drcrtype'] == 1):
                          $cr = $ledger['pd_amount'];
                            $dr = 0;
                            endif;

                 $bf = ($bf + $cr) - $dr;
           endforeach;
          $data['note'] = "Balance for Selected Contribution Type is: NGN".number_format($bf);
          $data['balance'] = $bf;
        echo json_encode($data);

        else:
            $data['note'] = "Balance for Selected Contribution Type is: NGN".number_format($bf);
            $data['balance'] = $bf;
            echo json_encode($data);
            endif;



    }

    public function get_ct(){
        $staff_id = $_POST['staff_id'];
        $ledgers = $this->pd->get_payment_staff_id($staff_id);
        $i = 0;
        foreach ($ledgers as $ledger):
            $data[$i] = $this->contribution_type->where(['contribution_type_id' => $ledger->pd_ct_id])->first();
            $i++;
        endforeach;
        echo json_encode($data);
    }

}
