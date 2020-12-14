<?php 
namespace App\Controllers;
use App\Models\StateModel; 

class Policyconfigcontroller extends BaseController
{
    
	public function index()
	{
        $data = [];
        //$states = new StateModel;
        //$data['states'] = $states->findAll();
		return view('pages/policy-config/index', $data);
	}


    

    
}
