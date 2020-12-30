<?php namespace App\Controllers;

class ChartOfAccountController extends BaseController
{
	public function index()
	{
		return view('pages/coa/index');
    }
    
	public function create()
	{
		return view('pages/coa/add-new-account');
	}

	//--------------------------------------------------------------------

}
