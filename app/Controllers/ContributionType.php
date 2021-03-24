<?php


namespace App\Controllers;


use App\Models\ContributionTypeModel;
use App\Models\CoaModel;
use App\Models\PaymentDetailsModel;

class ContributionType extends BaseController
{

    public function __construct(){

        $this->contribution_type = new ContributionTypeModel();
	    $this->coa = new CoaModel();
        $this->pd = new PaymentDetailsModel();
    }
    public function contribution_type () {

        $method = $this->request->getMethod();
        if($method == 'post'):

            if($_POST['type'] == 1):

                    $this->validator->setRules( [
                        'contribution_type_name'=>[
                            'rules'=>'required',
                            'errors'=>[
                                'required'=>'Enter a name'
                            ]
                        ]

                    ]);

                    if ($this->validator->withRequest($this->request)->run()):



                            $check_contribution = $this->contribution_type->where('contribution_type_name', $_POST['contribution_type_name'])
                                ->findAll();



                            if($check_contribution):
	                            
	                            
	                            
                                $data = array(
                                    'msg' => 'Contribution type already exists',
                                    'type' => 'error',
                                    'location' => site_url('contribution_type')

                                );

                                echo view('pages/sweet-alert', $data);

                            else:
	
	                            $check_regular = $this->contribution_type->where('contribution_type_regular', 1)
		                            ->first();
                            
                            if($check_regular && ($_POST['contribution_type_regular'] == 1)):
	
	                            $data = array(
		                            'msg' => 'Only one Contribution Type can be regular',
		                            'type' => 'error',
		                            'location' => site_url('contribution_type')
	
	                            );
	
	                            echo view('pages/sweet-alert', $data);
	                            
	                            else:
                            
                                $v = $this->contribution_type->save($_POST);
	                            
	                            endif;

                                if($v):

                                    $data = array(
                                        'msg' => 'Action Successful',
                                        'type' => 'success',
                                        'location' => site_url('contribution_type')

                                    );

                                    return view('pages/sweet-alert', $data);

                                else:

                                    $data = array(
                                        'msg' => 'An error Occurred',
                                        'type' => 'error',
                                        'location' => site_url('contribution_type')

                                    );

                                    return view('pages/sweet-alert', $data);

                                endif;
                            endif;


                    else:
                        $arr = $this->validator->getErrors();

                        $data = array(
                            'msg' => implode(", ", $arr),
                            'type' => 'error',
                            'location' => site_url('contribution_type')

                        );

                        echo view('pages/sweet-alert', $data);

                        //print_r($this->validator->getErrors());

                    endif;

             endif;

             if($_POST['type'] == 2):


                 $this->validator->setRules( [
                     'contribution_type_name'=>[
                         'rules'=>'required',
                         'errors'=>[
                             'required'=>'Enter a name'
                         ]
                     ]

                 ]);

                 if ($this->validator->withRequest($this->request)->run()):



                     $check_contribution = $this->contribution_type->where('contribution_type_name', $_POST['contribution_type_name'])
                         ->findAll();
                 
                 $i = false;



                     if($i):
                         $data = array(
                             'msg' => 'Contribution type already exists',
                             'type' => 'error',
                             'location' => site_url('contribution_type')

                         );

                         echo view('pages/sweet-alert', $data);

                     else:

                         $data = [
                             'contribution_type_id' => $this->request->getVar('contribution_type_id'),
                             'contribution_type_name' => $this->request->getVar('contribution_type_name'),
	                         'contribution_type_glcode' =>$this->request->getVar('contribution_type_glcode')

                         ];

                         $v = $this->contribution_type->save($data);

                         if($v):

                             $data = array(
                                 'msg' => 'Action Successful',
                                 'type' => 'success',
                                 'location' => site_url('contribution_type')

                             );

                             return view('pages/sweet-alert', $data);

                         else:

                             $data = array(
                                 'msg' => 'An Error Occurred',
                                 'type' => 'error',
                                 'location' => site_url('contribution_type')

                             );

                             return view('pages/sweet-alert', $data);
                         endif;
                     endif;


                 else:
                     $arr = $this->validator->getErrors();

                     $data = array(
                         'msg' => implode(", ", $arr),
                         'type' => 'error',
                         'location' => site_url('contribution_type')

                     );

                     echo view('pages/sweet-alert', $data);

                     //print_r($this->validator->getErrors());

                 endif;


             endif;


            if($_POST['type'] == 3):
	           
	           
						$check_pd = $this->pd->where('pd_ct_id', $this->request->getVar('contribution_type_id'))->first();
            
            if(empty($check_pd)):

                        $v = $this->contribution_type->delete($this->request->getVar('contribution_type_id'));

                        if($v):

                            $data = array(
                                'msg' => 'Action Successful',
                                'type' => 'success',
                                'location' => site_url('contribution_type')

                            );

                            return view('pages/sweet-alert', $data);

                        else:

                            $data = array(
                                'msg' => 'An error occured',
                                'type' => 'error',
                                'location' => site_url('contribution_type')

                            );

                            return view('pages/sweet-alert', $data);
                        endif;
                        
                        else:
	
	                        $data = array(
		                        'msg' => 'Cannot Delete Contribution Type, Savings already in use',
		                        'type' => 'error',
		                        'location' => site_url('contribution_type')
	
	                        );
	
	                        return view('pages/sweet-alert', $data);
	            
	            endif;

            endif;



        else:
	
	        $data['coas'] = $this->coa->where(['type' => 1])->findAll();
            $data['contribution_types'] = $this->contribution_type->findAll();
            $username = $this->session->user_username;
            $this->authenticate_user($username, 'pages/control-panel/contribution_type', $data);

        endif;

    }
}
