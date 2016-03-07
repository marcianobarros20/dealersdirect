<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Input; /* For input */
use Validator;
use Session;
use DB;
use Mail;
use Hash;
use Auth;

class HomeController extends Controller
{
    //
	public function __construct() {

		view()->share('home_class','active');
	}
	public function index()
	{
		return view('admin.home.index',array('title' => 'Dashboard','module_head'=>'Dashboard'));
	}

}
