<?php namespace App\Http\Controllers;

use stdClass;

class WelcomeController extends Controller {

    public function welcome() 
    {
        return view('welcome');
    }
}