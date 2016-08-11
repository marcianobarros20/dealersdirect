<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Socialite;
use App\Model\Client;          		  /* Model name*/
use App\Model\RequestQueue;          /* Model name*/
use App\Model\Dealer;          		/* Model name*/

use Redirect,Session;
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
    	if($request_id){
    	$RequestQueue = RequestQueue::find($request_id);
        $RequestQueue->fname=$name[0];
        $RequestQueue->lname=$name[1];
        $RequestQueue->phone="";
        $RequestQueue->email=$providerUser->email;
        $RequestQueue->zip="";
        $RequestQueue->type=1;
        if(isset($client->id)){
        $RequestQueue->client_id=$client->id;
    	}
        $RequestQueue->save();
    	}
        $client_info=Client::where('email',$providerUser->email)->first();
        $nam=ucfirst($client_info->first_name)." ".ucfirst($client_info->last_name);
            Session::put('client_userid', $client_info->id);
            Session::put('client_email', $client_info->email);
            Session::put('client_name', $nam);
            Session::save();
            Session::forget('guest_user_id');
         //client part end 
        return Redirect::to('client-dashboard');
        }
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

    

    
}
