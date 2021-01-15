<?php


namespace App\Controllers;
use App\Models\PayrollGroups;
use App\Models\ContributionTypeModel;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Routine extends BaseController
{

    public function __construct(){
        $this->pg = new PayrollGroups();
        $this->contribution_type = new ContributionTypeModel();

    }

    public function upload_routine(){
        $data = [];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/routine/upload_routine_base', $data);
    }


    public function contribution_upload(){

        $data['pgs'] = $this->pg->findAll();
        $data['cts'] = $this->contribution_type->findAll();
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/routine/contribution_upload', $data);

    }

    public function process_contribution_upload(){

        $this->validator->setRules( [
            'contribution_upload_pg'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Select a Payroll Group'
                ]
            ],

            'contribution_upload_ct'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Select a Contribution Type'
                ]
            ],

            'contribution_upload_date'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Enter a Date'
                ]
            ],

            'contribution_upload_narration'=>[
                'rules'=>'required',
                'errors'=>[
                    'required'=>'Enter a Narration'
                ]
            ],

        ]);

        if ($this->validator->withRequest($this->request)->run()):

            $contribution_type_id = $_POST['contribution_upload_ct'];
            $payroll_group_id = $_POST['contribution_upload_pg'];
            $date = $_POST['contribution_upload_date'];
            $narration = $_POST['contribution_upload_narration'];

                    if($_FILES["select_excel"]["name"] != ''):

            $allowed_extension = array('xls', 'xlsx');
            $file_array = explode(".", $_FILES['select_excel']['name']);
            $file_extension = end($file_array);
            if(in_array($file_extension, $allowed_extension)):

                $reader = IOFactory::createReader('Xlsx');
                $spreadsheet = $reader->load($_FILES['select_excel']['tmp_name']);
                $worksheet = $spreadsheet->getActiveSheet();
                $rows = $worksheet->toArray();
                //0 IS STAFF_id
                //1 is name
                // 2 is amount
                // do not forget

               unset($rows[0]);
                echo '<br>';
                foreach ($rows as $row):

                    $staff_id = $row[0];
                    $amount = $row[2];







                endforeach;

//                foreach ($rows as $row):
//
//                    endforeach;

            else:

                $data = array(
                    'msg' => 'Only .xlsx, .xls, .csv extensions are allowed',
                    'type' => 'error',
                    'location' => base_url('contribution_upload')

                );

                return view('pages/sweet-alert', $data);
           endif;

        else:

            $data = array(
                'msg' => 'Please Select a File.',
                'type' => 'error',
                'location' => base_url('contribution_upload')

            );

            return view('pages/sweet-alert', $data);
        endif;

        else:

            $arr = $this->validator->getErrors();

            $data = array(
                'msg' => implode(", ", $arr),
                'type' => 'error',
                'location' => site_url('contribution_upload')

            );

            echo view('pages/sweet-alert', $data);

            endif;




    }
}
