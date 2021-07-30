<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		
		$url = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
		$id = "tutorialspoint.test@gmail.com";
		$pwd = "cohondob_123";
		$mailbox = imap_open($url, $id, $pwd);
		if($mailbox){
			print("Connection established....");
		} else {
			print("Connection failed");
		}
	}

	//--------------------------------------------------------------------

}
