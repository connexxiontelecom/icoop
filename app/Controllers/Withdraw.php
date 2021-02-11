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
use App\Models\PolicyConfigModel;

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
        $this->policy = new PolicyConfigModel();

    }

    public function new_withdraw(){
        $method = $this->request->getMethod();

        if($method == 'get'):

            $data['policy_configs'] = $this->policy->first();
            $data['cts'] = $this->contribution_type->findAll();
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/withdraw/new_withdraw', $data);

        endif;

        if($method == 'post'):


            $this->validator->setRules( [
                'withdraw_staff_id'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Enter Staff ID'
                    ]
                ],

                'withdraw_ct_id'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Select a Contribution Type'
                    ]
                ],

                'withdraw_amount'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'Enter an amount'
                    ]
                ],



            ]);
            if ($this->validator->withRequest($this->request)->run()):


            $file = $this->request->getFile('withdraw_file');

            if(!empty($file)):

		                if($file->isValid() && !$file->hasMoved()):

		                    $extension = $file->guessExtension();
		                    $extension = strtolower($extension);

		                    if($extension == 'pdf'):

		                            $file_name = $file->getRandomName();

		                            $_POST['withdraw_doc'] = $file_name;

		                            $file->move('.uploads/withdrawals', $file_name);

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

		                            $_POST['withdraw_charges'] = ($_POST['withdraw_charge']/100)*$withdraw_amount;
		                            unset($_POST['withdraw_charge']);
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


		                        else:

		                            $data = array(
		                                'msg' => 'Only PDF files are allowed',
		                                'type' => 'error',
		                                'location' => base_url('new_withdraw')

		                            );

		                            echo view('pages/sweet-alert', $data);

		                        endif;

		                        
		                     else:
			
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

		                   $_POST['withdraw_charges'] = ($_POST['withdraw_charge']/100)*$withdraw_amount;
		                   unset($_POST['withdraw_charge']);
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
		                 
		                 endif;
	            
	       
		                 
		            endif;
	
//	            if(empty($file)):
//
//			           echo "i am without upload";
//
//
//               endif;
               






            else:

                $arr = $this->validator->getErrors();

                $data = array(
                    'msg' => implode(", ", $arr),
                    'type' => 'error',
                    'location' => base_url('new_withdraw')

                );

                echo view('pages/sweet-alert', $data);


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
        $policy_configs = $this->policy->first();

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
           $max_withdrawal = $policy_configs['max_withdrawal_amount'];
           $bf_w = ($max_withdrawal/100)*$bf;



          $data['note'] = 'Withdrawal Balance: NGN'.number_format($bf_w).'<br>'.'Savings Balance: NGN'.number_format($bf);
          $data['balance'] = $bf_w;
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

    public function verify_withdrawal(){

        $method = $this->request->getMethod();

        if($method == 'get'):

            $new_withdraw_array = array();
            $wits = $this->withdraw->get_pending_withdrawals();
            $i = 0;
            foreach ($wits as $wit):

                $bf = 0;

                $ledgers =  $this->pd->where(['pd_staff_id' => $wit['withdraw_staff_id'], 'pd_ct_id' => $wit['withdraw_ct_id']])
//                        ->orderBy('pd_transaction_date', 'DESC')
                    ->findAll();
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

                $update_array[$i] = array(
                    'balance' => $bf,
                );

                $new_withdraw_array[$i] = $wit + $update_array[$i];
                $i++;
            endforeach;

            $data['withdrawals'] = $new_withdraw_array;
           // print_r($data['withdrawals']);
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/withdraw/verify_withdrawal', $data);

        endif;

        if($method == 'post'):

            $withdraw_status = $_POST['withdraw_status'];

            if($withdraw_status == 1):

             $_POST['withdraw_verify_date'] = date('Y-m-d');
            $_POST['withdraw_verify_by']  = $this->session->user_first_name." ".$this->session->user_last_name;

            $v = $this->withdraw->save($_POST);

                if($v):

                    $data = array(
                        'msg' => 'Action Successful',
                        'type' => 'success',
                        'location' => base_url('verify_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);

                else:
                    $data = array(
                        'msg' => 'An Error Occurred',
                        'type' => 'error',
                        'location' => base_url('verify_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);


                endif;


            endif;
            if($withdraw_status == 3):

                $_POST['withdraw_discarded_date'] = date('Y-m-d');
                $_POST['withdraw_discarded_by']  = $this->session->user_first_name." ".$this->session->user_last_name;

                $v = $this->withdraw->save($_POST);

                if($v):

                    $data = array(
                        'msg' => 'Action Successful',
                        'type' => 'success',
                        'location' => base_url('verify_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);

                else:
                    $data = array(
                        'msg' => 'An Error Occurred',
                        'type' => 'error',
                        'location' => base_url('verify_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);


                endif;


            endif;




        endif;
    }

    public function approve_withdrawal(){

        $method = $this->request->getMethod();

        if($method == 'get'):

            $new_withdraw_array = array();
            $wits = $this->withdraw->get_verified_withdrawals();
            $i = 0;
            foreach ($wits as $wit):

                $bf = 0;

                $ledgers =  $this->pd->where(['pd_staff_id' => $wit['withdraw_staff_id'], 'pd_ct_id' => $wit['withdraw_ct_id']])
//                        ->orderBy('pd_transaction_date', 'DESC')
                    ->findAll();
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

                $update_array[$i] = array(
                    'balance' => $bf,
                );

                $new_withdraw_array[$i] = $wit + $update_array[$i];
                $i++;
            endforeach;

            $data['withdrawals'] = $new_withdraw_array;
            // print_r($data['withdrawals']);
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/withdraw/approve_withdrawal', $data);

        endif;

        if($method == 'post'):

            $withdraw_status = $_POST['withdraw_status'];

            if($withdraw_status == 2): //approve

                $_POST['withdraw_approved_date'] = date('Y-m-d');
                $_POST['withdraw_approved_by']  = $this->session->user_first_name." ".$this->session->user_last_name;

                $v = $this->withdraw->save($_POST);

                if($v):

//                    $temp_payment = $this->withdraw->where(['withdraw_id' => $_POST['withdraw_id']])->first();
//                    $coop = $this->cooperator->where(['cooperator_staff_id' =>$temp_payment['withdraw_staff_id'] ])->first();
//                    $payment_details_array = array(
//                        'pd_staff_id' => $temp_payment['withdraw_staff_id'],
//                        'pd_transaction_date' => $temp_payment['withdraw_date'],
//                        'pd_narration' => $temp_payment['withdraw_narration'],
//                        'pd_amount' => $temp_payment['withdraw_amount'],
//                        'pd_drcrtype' => 2,
//                        'pd_ct_id' => $temp_payment['withdraw_ct_id'],
//                        'pd_pg_id' => $coop['cooperator_payroll_group_id'],
//                        'pd_ref_code' => time(),
//                    );
//
//
//                    $v =   $this->pd->save($payment_details_array);

                    if($v):
                        $data = array(
                            'msg' => 'Action Successful',
                            'type' => 'success',
                            'location' => base_url('approve_withdrawal')

                        );
                        return view('pages/sweet-alert', $data);
                    else:
                        $data = array(
                            'msg' => 'An Error Occurred',
                            'type' => 'error',
                            'location' => base_url('approve_withdrawal')

                        );
                        return view('pages/sweet-alert', $data);


                    endif;


                else:
                    $data = array(
                        'msg' => 'An Error Occurred',
                        'type' => 'error',
                        'location' => base_url('approve_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);


                endif;


            endif;
            if($withdraw_status == 3):

                $_POST['withdraw_discarded_date'] = date('Y-m-d');
                $_POST['withdraw_discarded_by']  = $this->session->user_first_name." ".$this->session->user_last_name;

                $v = $this->withdraw->save($_POST);

                if($v):

                    $data = array(
                        'msg' => 'Action Successful',
                        'type' => 'success',
                        'location' => base_url('approve_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);

                else:
                    $data = array(
                        'msg' => 'An Error Occurred',
                        'type' => 'error',
                        'location' => base_url('approve_withdrawal')

                    );
                    return view('pages/sweet-alert', $data);


                endif;


            endif;




        endif;
    }

}
