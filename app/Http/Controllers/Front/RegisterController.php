<?php

namespace App\Http\Controllers\Front;

use App\Model\Dealer;          /* Model name*/
use App\Model\DealerMakeMap;          /* Model name*/
use App\Model\Make;                                         /* Model name*/
use App\Model\Carmodel;                                     /* Model name*/
use App\Model\Caryear;                                      /* Model name*/
use App\Model\RequestQueue;		                            /* Model name*/
use App\Model\RequestDealerLog;                             /* Model name*/
use App\Model\DealerDetail;                                 /* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use Illuminate\Support\Facades\Request;
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use Session;
use Hash;
use Mail;
use App\Helper\helpers;
use Validator;
class RegisterController extends Controller
{
    //

     public function dealerRegister() {
        	//$password = Request::input('password');
        	//$conf_password = Request::input('conf_password');
            // dd(Request::input());
            $tamo=time()."DEALERS";
            $hashpassword = Hash::make(Request::input('password'));
            $Dealer['dealership_name'] =Request::input('d_name');
            $Dealer['first_name'] =Request::input('fname');
            $Dealer['last_name'] =Request::input('lname');
            $Dealer['email'] =Request::input('email');
            $Dealer['zip'] =Request::input('zip');
            $Dealer['password'] =$hashpassword;
            $Dealer['code_number'] =$tamo;
            $Dealers_row=Dealer::create($Dealer);
            $lastinsertedId = $Dealers_row->id;

                    $DealerDetail['dealer_id']=$lastinsertedId;
                    $DealerDetail['zip']=Request::input('zip');
                    $DealerDetail['phone']=Request::input('phone');
                    $DealerDetail['address']=Request::input('address');
                    $DealerDetail['state_id']=Request::input('state_id');
                    $DealerDetail['city_id']=Request::input('city_id');
                    $DealerDetail['image']="";
                    DealerDetail::create($DealerDetail);
                    $make=Request::input('make');
                        foreach ($make as $key => $value) {
                            $DealerMakeMap['dealer_id']=$lastinsertedId;
                            $DealerMakeMap['make_id']=$value;
                            DealerMakeMap::create($DealerMakeMap);
                            self::fetchRequestLog($lastinsertedId,$value);
                        }
                    $Dealerx = Dealer::where('id', $lastinsertedId)->first();
                    $namx=ucfirst($Dealerx->first_name)." ".ucfirst($Dealerx->last_name);
                    Session::put('dealer_userid', $Dealerx->id);
                    Session::put('dealer_email', $Dealerx->email);
                    Session::put('dealer_name', $namx);
                    Session::put('dealer_parent', $Dealerx->parent_id);
                    Session::save();
                    return redirect('dealer-dashboard');
            
	   }

     
     public function fetchRequestLog($lastinsertedId,$value){
     	$RequestQueue_row=RequestQueue::where('make_id', $value)->get();
     	foreach ($RequestQueue_row as $key => $RequestQueue) {
     			$RequestDealerLog['dealer_id']=$lastinsertedId;
                $RequestDealerLog['dealer_admin']=0;
                $RequestDealerLog['request_id']=$RequestQueue->id;
                $RequestDealerLog['make_id']=$value;
                $RequestDealerLog['status']=1;
                $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
                $lastlog = $RequestDealerLog_row->id;
                self::SendRemindermail($lastlog);
     	}

     }
     public function SendRemindermail($maskval){
            $RequestDealerLog=RequestDealerLog::where('id', $maskval)->with('makes','dealers')->first();
            
            $requestqueuex['make']=$RequestDealerLog->makes->name;
            $mid=$RequestDealerLog->requestqueue->carmodel_id;
            $Carmodel=Carmodel::where("id",$mid)->first();
            $requestqueuex['model']=$Carmodel->name;
            $requestqueuex['year']=$RequestDealerLog->requestqueue->year;
            $requestqueuex['conditions']=$RequestDealerLog->requestqueue->condition;
            $requestqueuex['dealername']=$RequestDealerLog->dealers->first_name."".$RequestDealerLog->dealers->last_name;
            $requestqueuex['dealeremail']=$RequestDealerLog->dealers->email;



            $user_name = $requestqueuex['dealername'];
            $user_email = $requestqueuex['dealeremail'];
            $admin_users_email="hello@tier5.us";
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($maskval);
            
            $sent = Mail::send('front.email.activateLink', array('name'=>$user_name,'email'=>$user_email,'activate_link'=>$activateLink, 'make'=>$requestqueuex['make'],'model'=>$requestqueuex['model'],'year'=>$requestqueuex['year'],'conditions'=>$requestqueuex['conditions']), 
            function($message) use ($admin_users_email, $user_email,$user_name)
            {
            $message->from($admin_users_email);
            $message->to($user_email, $user_name)->subject('Request From Dealers Direct');
            });

            return $requestqueuex;
    }
}