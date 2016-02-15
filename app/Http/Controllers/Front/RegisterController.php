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
use Hash;
use App\Helper\helpers;
class RegisterController extends Controller
{
    //

     public function dealerRegister(){
     	
     	$tamo=time()."DEALERS";
     	$hashpassword = Hash::make(Request::input('password'));
     	$Dealer['first_name'] =Request::input('fname');
		$Dealer['last_name'] =Request::input('lname');
		$Dealer['email'] =Request::input('email');
		$Dealer['password'] =$hashpassword;
		$Dealer['code_number'] =$tamo;
		
		$Dealers_row=Dealer::create($Dealer);
		$lastinsertedId = $Dealers_row->id;

		$make=Request::input('make');
		foreach ($make as $key => $value) {
			$DealerMakeMap['dealer_id']=$lastinsertedId;
			$DealerMakeMap['make_id']=$value;
			DealerMakeMap::create($DealerMakeMap);
		}


     }
}
