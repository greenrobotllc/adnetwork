<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class Account extends Controller
{

	public function index()
	{
	    //return "account";
	    //, compact('widgets')
	    $id = Auth::id();
	    $user = User::findOrFail($id);

		$api_key = $user->api_key;
		

		//https://stackoverflow.com/a/14270161/211457
		
		if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    	isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    	$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  		$protocol = 'https://';
	}
	else {
		  $protocol = 'http://';
		}


		$api_url = $protocol . $_SERVER['HTTP_HOST'];
		$todays_date = date('Y-m-d');
	    return view('account.index', compact('api_key', 'api_url', 'todays_date', 'id'));

	}
}
