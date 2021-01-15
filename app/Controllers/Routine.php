<?php


namespace App\Controllers;


class Routine extends BaseController
{

    public function __construct(){


    }

    public function upload_routine(){
        $data = [];
        $username = $this->session->user_username;
        $this->authenticate_user($username, 'pages/routine/upload_routine_base', $data);
    }


    public function contribution_upload(){


    }
}
