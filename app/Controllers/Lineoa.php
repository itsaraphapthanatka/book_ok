<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Lineoa extends Controller{
	public function __construct()
	{
		helper('line_oa_api');
	}
	public function api()
	{
		$userid = $_GET['line'];
		$customercode = $_GET['customercode'];
		$customername = $_GET['customername'];
		$res['customername'] = $_GET['customername'];
		$buydate = $_GET['buydate'];
		$frame = $_GET['Frame'];
		$lens = $_GET['Lens'];
		$Final_RE = $_GET['Final_RE'];
		$Final_LE = $_GET['Final_LE'];
		$line = "https://eyelism.com/botpush/botpush.php";
		$data = array( 
			"id" => $userid,
			"type" => "flex",
			"text" => $customercode,
			"customername" => $customername,
			"buydate" => $buydate,
			"frame" => $frame,
			"lens" => $lens,
			"Final_RE" => $Final_RE,
			"Final_LE" => $Final_LE
		);
		line_oa_api($data,$line);
		echo view('welcome_message',$res);
		// $this->close_method();
	}
}

?>