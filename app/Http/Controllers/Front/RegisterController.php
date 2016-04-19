<?php

namespace App\Http\Controllers\Front;

use App\Model\Dealer;          /* Model name*/
use App\Model\DealerMakeMap;          /* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Support\Facades\Request;
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use Session;
use Hash;
use App\Helper\helpers;
use Validator;
use Redirect;
class RegisterController extends Controller
{
    //

     public function dealerRegister(){

     	$rules = array(
     	'fname' => 'required', 
     	'lname' => 'required',
     	'email' => 'required|email',
     	'zip' => 'required|numeric',
     	'password' => 'required|min:6',
     	'conf_password' => 'required|min:6',
     	'make[]' => 'min:1'
     	);
     	$validator = Validator::make(Request::all(), $rules);
     	if ($validator->fails())
        {
        	$msg = $validator->messages();
        	Session::flash('error',$msg );
        	return redirect('dealer-signup');
        } 
        else 
        {
        	$password = Request::input('password');
        	$conf_password = Request::input('conf_password');
        	if ($password !== $conf_password) {
        		Session::flash('error1','Password and Confirm Password should be same' );
        		return redirect('dealer-signup');
        	}

        $tamo=time()."DEALERS";
     	$hashpassword = Hash::make(Request::input('password'));
     	$Dealer['first_name'] =Request::input('fname');
		$Dealer['last_name'] =Request::input('lname');
		$Dealer['email'] =Request::input('email');
		$Dealer['zip'] =Request::input('zip');
		$Dealer['password'] =$hashpassword;
		$Dealer['code_number'] =$tamo;
		
		$Dealers_row=Dealer::create($Dealer);
		$lastinsertedId = $Dealers_row->id;

		$make=Request::input('make');
		foreach ($make as $key => $value) {
			$DealerMakeMap['dealer_id']=$lastinsertedId;
			$DealerMakeMap['make_id']=$value;
			DealerMakeMap::create($DealerMakeMap);
			//Self::fetchrequestlog($lastinsertedId);
		}
		$Dealerx = Dealer::where('id', $lastinsertedId)->first();
		$namx=ucfirst($Dealerx->first_name)." ".ucfirst($Dealerx->last_name);
		Session::put('dealer_userid', $Dealerx->id);
		Session::put('dealer_email', $Dealerx->email);
		Session::put('dealer_name', $namx);
		Session::put('dealer_parent', $Dealer->parent_id);

		Session::save();
		return redirect('dealer-dashboard');
             
        }
     }

}
