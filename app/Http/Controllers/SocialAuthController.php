<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Support\Facades\Request;
use Socialite;
use App\Model\Client;          		  /* Model name*/
use App\Model\RequestQueue;          /* Model name*/
use App\Model\Dealer;          		/* Model name*/
use App\Model\TradeinRequest;               /* Model name*/
use App\Model\DealerMakeMap;               /* Model name*/
use App\Model\RequestDealerLog;               /* Model name*/
use App\Model\Carmodel;               /* Model name*/
use Redirect,Session,Input,Mail;

class SocialAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {	
    	$login_type=Session::get('login_type');
    	$providerUser = \Socialite::driver('facebook')->user();//fb user data
    	$fb_user_token=Session::put('fb_user_token',$providerUser->token);//fb_client_token
        $name=explode(' ',trim($providerUser->name));
        //client part 
        if($login_type==2){
        $client_info_count=Client::where('email',$providerUser->email)->count();
        if($client_info_count==0){
        $client=new Client;
        $client->first_name=$name[0];
        $client->last_name=$name[1];
        $client->email=$providerUser->email;
        $client->code_number='SCLIENT'.$providerUser->id;
        $client->save();
        }
    	$request_id=Session::get('guest_user_id');//request_id
        if($request_id!=0){
        $client_id=Client::where('email',$providerUser->email)->first();
    	$RequestQueue = RequestQueue::find($request_id);
        $RequestQueue->fname=$name[0];
        $RequestQueue->lname=$name[1];
        $RequestQueue->phone="0";
        $RequestQueue->email=$providerUser->email;
        $RequestQueue->zip="0";
        $RequestQueue->type=1;
        $RequestQueue->client_id=$client_id->id;
        $RequestQueue->save();
    	}
        $cachedata=Session::get('cachedata');
        //client login with a request 
        if($cachedata!=null){
                    $RequestQueue=array();
                    $client_info=Client::where('email',$providerUser->user['emails'][0]['value'])->first();
                    $make_search=$cachedata['make_search'];
                    $model_search=$cachedata['model_search'];
                    $condition_search=$cachedata['condition_search'];
                    $year_search=$cachedata['year_search'];
                    $tamo=$cachedata['tamo'];
                    $mtamo=$cachedata['mtamo'];
                    $RequestQueue['make_id'] =$make_search;
                    $RequestQueue['carmodel_id'] =$model_search;
                    $RequestQueue['condition'] =$condition_search;
                    $RequestQueue['year'] =$year_search;
                    $RequestQueue['total_amount'] =$tamo;
                    $RequestQueue['monthly_amount'] =$mtamo;
                    $RequestQueue['fname'] =$client_info->first_name;
                    $RequestQueue['lname'] =$client_info->last_name;
                    $RequestQueue['phone'] =$client_info->phone;
                    $RequestQueue['type'] =1;
                    $RequestQueue['email'] =$client_info->email;
                    $RequestQueue['client_id']=$client_info->id;
                    $RequestQueue['im_type']=1;

                    if($cachedata['tradein']=="yes"){
                        $TradeinRequest=array();
                        $RequestQueue['trade_in']=1;
                        $TradeinRequest['make_id'] =$cachedata['trademake_search'];
                        $TradeinRequest['carmodel_id'] =$cachedata['trademodel_search'];
                        $TradeinRequest['condition'] =$cachedata['tradecondition_search'];
                        $TradeinRequest['year'] =$cachedata['tradeyear_search'];
                        $owe=Request::Input('owe');
                            if(isset($cachedata['owe'])){
                                $TradeinRequest['owe'] =$cachedata['owe'];
                                $TradeinRequest['owe_amount'] =$cachedata['owe_amount'];

                            }
                        $TradeinRequest['im_type']=1;
                        $TradeinRequest['fname'] =$client_info->first_name;
                        $TradeinRequest['lname'] =$client_info->last_name;
                        $TradeinRequest['phone'] =$client_info->phone;
                        $TradeinRequest['type'] =1;
                        $TradeinRequest['email'] =$client_info->email;
                        $TradeinRequest['client_id']=$client_info->id;
                    }
                    $RequestQueue_row=RequestQueue::create($RequestQueue);
                    $lastinsertedId = $RequestQueue_row->id;
                    $TradeinRequest['request_queue_id'] =$lastinsertedId;
                    $TradeinRequest=TradeinRequest::create($TradeinRequest);
                    $DealerMakeMap = DealerMakeMap::where('make_id', $make_search)->with('dealers')->get();
                    foreach ($DealerMakeMap as $value) {
                        if($value->dealers->parent_id==0){
                            $RequestDealerLog['dealer_id']=$value->dealer_id;
                            $RequestDealerLog['dealer_admin']=0;
                            $RequestDealerLog['request_id']=$lastinsertedId;
                            $RequestDealerLog['make_id']=$make_search;
                            $RequestDealerLog['status']=1;
                            $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
                            $lastlog = $RequestDealerLog_row->id;
                            self::SendRemindermail($lastlog);
                        }
                        else{
                            $RequestDealerLog['dealer_id']=$value->dealers->parent_id;
                            $RequestDealerLog['dealer_admin']=$value->dealer_id;
                            $RequestDealerLog['request_id']=$lastinsertedId;
                            $RequestDealerLog['make_id']=$make_search;
                            $RequestDealerLog['status']=1;
                            $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
                            $lastlog = $RequestDealerLog_row->id;
                            self::SendRemindermail($lastlog);
                        }
                    }
                }//client sign in with the request end
        $client_info=Client::where('email',$providerUser->email)->first();
        $nam=ucfirst($client_info->first_name)." ".ucfirst($client_info->last_name);
            Session::put('client_userid', $client_info->id);
            Session::put('client_email', $client_info->email);
            Session::put('client_name', $nam);
            Session::save();
            Session::forget('guest_user_id');
         //client part end 
        return Redirect::to('client-dashboard');
        }//dealers login 
        if($login_type==1){
        	$dealers_info_count=Dealer::where('email',$providerUser->email)->count();
        	if($dealers_info_count==0){
        		$dealers=new Dealer;
        		$dealers->first_name=$name[0];
        		$dealers->last_name=$name[1];
        		$dealers->email=$providerUser->email;
        		$dealers->zip="";
        		$dealers->code_number='S_DEALERS'.$providerUser->id;
        		$dealers->save();
        		}
        	$dealers_info=Dealer::where('email',$providerUser->email)->first();
        	$nam=ucfirst($dealers_info->first_name)." ".ucfirst($dealers_info->last_name);
                        Session::put('dealer_userid', $dealers_info->id);
                        Session::put('dealer_email', $dealers_info->email);
                        Session::put('dealer_name', $nam);
                        Session::put('dealer_parent', $dealers_info->parent_id);
                        Session::save();
                        Session::forget('login_type');
        	return Redirect::to('dealer-dashboard');
        	}
        
    }
    public function getSocialRedirect(){
        return Socialite::driver('google')->redirect();
    }
    public function getSocialHandle(){
        $providerUser = \Socialite::driver('google')->user();//fb user data
        $login_type=Session::get('login_type');
        $google_user_token=Session::put('fb_user_token',$providerUser->token);//google_client_token
        //client part
        if($login_type==2){
        $client_info_count=Client::where('email',$providerUser->user['emails'][0]['value'])->count();
        if($client_info_count==0){
        $client=new Client;
        $client->first_name=$providerUser->user['name']['givenName'];
        $client->last_name=$providerUser->user['name']['familyName'];
        $client->email=$providerUser->user['emails'][0]['value'];
        $client->code_number='SCLIENT'.$providerUser->id;
        $client->save();
        }
        $request_id=Session::get('guest_user_id');//request_id
        if($request_id!=0){
        $client_id=Client::where('email',$providerUser->user['emails'][0]['value'])->first();
        $RequestQueue = RequestQueue::find($request_id);
        $RequestQueue->fname=$providerUser->user['name']['givenName'];
        $RequestQueue->lname=$providerUser->user['name']['familyName'];
        $RequestQueue->phone="0";
        $RequestQueue->email=$providerUser->user['emails'][0]['value'];
        $RequestQueue->zip="0";
        $RequestQueue->type=1;
        $RequestQueue->client_id=$client_id->id;
        $RequestQueue->save();
        }
        $cachedata=Session::get('cachedata');
        //client login with a request 
        if($cachedata!=null){
                    $RequestQueue=array();
                    $client_info=Client::where('email',$providerUser->user['emails'][0]['value'])->first();
                    $make_search=$cachedata['make_search'];
                    $model_search=$cachedata['model_search'];
                    $condition_search=$cachedata['condition_search'];
                    $year_search=$cachedata['year_search'];
                    $tamo=$cachedata['tamo'];
                    $mtamo=$cachedata['mtamo'];
                    $RequestQueue['make_id'] =$make_search;
                    $RequestQueue['carmodel_id'] =$model_search;
                    $RequestQueue['condition'] =$condition_search;
                    $RequestQueue['year'] =$year_search;
                    $RequestQueue['total_amount'] =$tamo;
                    $RequestQueue['monthly_amount'] =$mtamo;
                    $RequestQueue['fname'] =$client_info->first_name;
                    $RequestQueue['lname'] =$client_info->last_name;
                    $RequestQueue['phone'] =$client_info->phone;
                    $RequestQueue['type'] =1;
                    $RequestQueue['email'] =$client_info->email;
                    $RequestQueue['client_id']=$client_info->id;
                    $RequestQueue['im_type']=1;

                    if($cachedata['tradein']=="yes"){
                        $TradeinRequest=array();
                        $RequestQueue['trade_in']=1;
                        $TradeinRequest['make_id'] =$cachedata['trademake_search'];
                        $TradeinRequest['carmodel_id'] =$cachedata['trademodel_search'];
                        $TradeinRequest['condition'] =$cachedata['tradecondition_search'];
                        $TradeinRequest['year'] =$cachedata['tradeyear_search'];
                        $owe=Request::Input('owe');
                            if(isset($cachedata['owe'])){
                                $TradeinRequest['owe'] =$cachedata['owe'];
                                $TradeinRequest['owe_amount'] =$cachedata['owe_amount'];

                            }
                        $TradeinRequest['im_type']=1;
                        $TradeinRequest['fname'] =$client_info->first_name;
                        $TradeinRequest['lname'] =$client_info->last_name;
                        $TradeinRequest['phone'] =$client_info->phone;
                        $TradeinRequest['type'] =1;
                        $TradeinRequest['email'] =$client_info->email;
                        $TradeinRequest['client_id']=$client_info->id;
                    }
                    $RequestQueue_row=RequestQueue::create($RequestQueue);
                    $lastinsertedId = $RequestQueue_row->id;
                    $TradeinRequest['request_queue_id'] =$lastinsertedId;
                    $TradeinRequest=TradeinRequest::create($TradeinRequest);
                    $DealerMakeMap = DealerMakeMap::where('make_id', $make_search)->with('dealers')->get();
                    $RequestDealerLog=array();
                    foreach ($DealerMakeMap as $value) {
                        if($value->dealers->parent_id==0){
                            $RequestDealerLog['dealer_id']=$value->dealer_id;
                            $RequestDealerLog['dealer_admin']=0;
                            $RequestDealerLog['request_id']=$lastinsertedId;
                            $RequestDealerLog['make_id']=$make_search;
                            $RequestDealerLog['status']=1;
                            $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
                            $lastlog = $RequestDealerLog_row->id;
                            self::SendRemindermail($lastlog);
                        }
                        else{
                            $RequestDealerLog['dealer_id']=$value->dealers->parent_id;
                            $RequestDealerLog['dealer_admin']=$value->dealer_id;
                            $RequestDealerLog['request_id']=$lastinsertedId;
                            $RequestDealerLog['make_id']=$make_search;
                            $RequestDealerLog['status']=1;
                            $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
                            $lastlog = $RequestDealerLog_row->id;
                            self::SendRemindermail($lastlog);
                        }
                    }
                }//client sign in with the request end
        $client_info=Client::where('email',$providerUser->user['emails'][0]['value'])->first();
        $nam=ucfirst($client_info->first_name)." ".ucfirst($client_info->last_name);
            Session::put('client_userid', $client_info->id);
            Session::put('client_email', $client_info->email);
            Session::put('client_name', $nam);
            Session::save();
            Session::forget('guest_user_id');
         //client part end     
        return Redirect::to('client-dashboard');
        }
        //dealers login 
        if($login_type==1){
            $dealers_info_count=Dealer::where('email',$providerUser->user['emails'][0]['value'])->count();
            if($dealers_info_count==0){
                $dealers=new Dealer;
                $dealers->first_name=$providerUser->user['name']['givenName'];
                $dealers->last_name=$providerUser->user['name']['familyName'];
                $dealers->email=$providerUser->user['emails'][0]['value'];
                $dealers->zip="";
                $dealers->code_number='S_DEALERS'.$providerUser->id;
                $dealers->save();
                }
            $dealers_info=Dealer::where('email',$providerUser->user['emails'][0]['value'])->first();
            $nam=ucfirst($dealers_info->first_name)." ".ucfirst($dealers_info->last_name);
                        Session::put('dealer_userid', $dealers_info->id);
                        Session::put('dealer_email', $dealers_info->email);
                        Session::put('dealer_name', $nam);
                        Session::put('dealer_parent', $dealers_info->parent_id);
                        Session::save();
                        Session::forget('login_type');
            return Redirect::to('dealer-dashboard');
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
