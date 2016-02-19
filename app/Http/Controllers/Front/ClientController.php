<?php

namespace App\Http\Controllers\Front;

use App\Model\Make;          /* Model name*/
use App\Model\Dealer;          /* Model name*/
use App\Model\DealerMakeMap;          /* Model name*/
use App\Model\RequestDealerLog;          /* Model name*/
use App\Model\Carmodel;          /* Model name*/
use App\Model\RequestQueue;          /* Model name*/
use App\Model\Client;          /* Model name*/
use App\Model\Caryear;          /* Model name*/
use App\Model\Style;          /* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Input;
use Mail;
//use Illuminate\Support\Facades\Session;
use Session;
use Illuminate\Support\Facades\Request;
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use App\Helper\helpers;


class ClientController extends BaseController
{
    //
    public function __construct(){
        parent::__construct();
        $obj = new helpers();
        if($obj->checkClientLogin())
        {
            $clientlogin=0;
        }
        else
        {
            $clientlogin=1;
        }

        view()->share('clientlogin',$clientlogin);
        view()->share('obj',$obj);
    }
    public function Dashboard(){
			$obj = new helpers();
			if(!$obj->checkClientLogin())
			{
			return redirect('client-signin');
			}
			return view('front.client.client_dashboard',array('title'=>'DEALERSDIRECT | Client Dashboard'));
    }
    public function signout(){
            Session::forget('client_userid');
            Session::forget('client_email');
            Session::forget('client_name');
            return redirect('client-signin');
    }
    public function signin(){
        
       $obj = new helpers();
        if($obj->checkClientLogin())
        {
            
            return redirect('client-dashboard');
        }
        if(Request::isMethod('post'))
        {
           $email = Request::input('email');
            $password = Request::input('password');
            $Client = Client::where('email', $email)->first();
            if($Client!=""){

                $Client_pass = $Client->password;
                // check for password
                if(Hash::check($password, $Client_pass)){

                   
                    
                    $nam=ucfirst($Client->first_name)." ".ucfirst($Client->last_name);
                    Session::put('client_userid', $Client->id);
                    Session::put('client_email', $Client->email);
                    Session::put('client_name', $nam);
                    
                    
                    Session::save();

                    return redirect('client-dashboard');

                }
                else{
                        Session::flash('error', 'Email and password does not match.'); 
                        return redirect('client-signin');
                    }
               
            }
            else{
                    Session::flash('error', 'Email and password does not match.'); 
                    return redirect('client-signin');
            }

        }

        return view('front.client.client_signin',array('title'=>'DEALERSDIRECT | Clients Signin'));
    }
    public function profile(){
    	$obj = new helpers();
			if(!$obj->checkClientLogin())
			{
			return redirect('client-signin');
			}
       	$client_userid=Session::get('client_userid');
       	$Client = Client::where('id', $client_userid)->first();
       	return view('front.client.client_profile',compact('Client'),array('title'=>'DEALERSDIRECT | Clients Profile'));
    }
    public function ProfileEditDetails(){
    	$obj = new helpers();
			if(!$obj->checkClientLogin())
			{
			return redirect('client-signin');
			}
        $client_userid=Session::get('client_userid');
        $fname=Request::input('fname');
        $lname=Request::input('lname');
        $phone=Request::input('phone');
        $Client = Client::find($client_userid);
        $Client->first_name = $fname;
        $Client->last_name = $lname;
        $Client->phone = $phone;
        $Client->save();
        $nam=ucfirst($fname)." ".ucfirst($lname);
        Session::forget('client_name');
        Session::put('client_name', $nam);
        Session::flash('message', 'Profile Details Successfully Changed'); 
        return redirect('/client/profile');
    }
    public function ProfileEditPassword(){
    	$obj = new helpers();
			if(!$obj->checkClientLogin())
			{
			return redirect('client-signin');
			}
        $client_userid=Session::get('client_userid');
        
        $hashpassword = Hash::make(Request::input('password'));
        $Client = Client::find($client_userid);
        $Client->password = $hashpassword;
        
        $Client->save();
        Session::flash('message', 'Password Successfully Changed'); 
       
        return redirect('/client/profile');
    }
    public function requestList(){
		$obj = new helpers();
			if(!$obj->checkClientLogin())
			{
				return redirect('client-signin');
			}
            $client_userid=Session::get('client_userid');
            $RequestQueue=RequestQueue::where('client_id', $client_userid)->with('makes')->get();
            
            $requestqueuex=array();
            foreach ($RequestQueue as $key=> $value) {
                    $requestqueuex[$key]['id']=$value->id;
                    $requestqueuex[$key]['status']=$value->status;
                    $requestqueuex[$key]['make']=$value->makes->name;
                    $mid=$value->carmodel_id;
                    $Carmodel=Carmodel::where("id",$mid)->first();
                    $requestqueuex[$key]['model']=$Carmodel->name;
                    $requestqueuex[$key]['year']=$value->year;
                    $requestqueuex[$key]['conditions']=$value->condition;
                    $requestqueuex[$key]['total']=$value->total_amount;
                    $requestqueuex[$key]['monthly']=$value->monthly_amount; 
            }
            return view('front.client.client_request_list',compact('requestqueuex'),array('title'=>'DEALERSDIRECT | Client Request'));
    }
    public function requestDetail($id=null){
            $RequestQueue=RequestQueue::where('id', $id)->with('makes')->first();
            $requestqueuex['id']=$RequestQueue->id;
            $requestqueuex['status']=$RequestQueue->status;
            $requestqueuex['make']=$RequestQueue->makes->name;
            $mid=$RequestQueue->carmodel_id;
            $Carmodel=Carmodel::where("id",$mid)->first();
            $requestqueuex['model']=$Carmodel->name;
            $requestqueuex['year']=$RequestQueue->year;
            $requestqueuex['conditions']=$RequestQueue->condition;
            $requestqueuex['total']=$RequestQueue->total_amount;
            $requestqueuex['monthly']=$RequestQueue->monthly_amount;
            $requestqueuex['cat']=$RequestQueue->created_at;
            
            return view('front.client.client_request_details',compact('requestqueuex'),array('title'=>'DEALERSDIRECT | Client Request Details'));
    }
    public function testmailnew(){
			$user_name = "PRODIPTO";
			$user_email = "prodipXXXTinka@gmail.com";
			$admin_users_email="prodip211085@gmail.com";
			//$activateLink = url().'/activateLink/'.base64_encode($register['email']).'/member';
			$activateLink ="Activatelink";
			$sent = Mail::send('front.email.activateLink', array('name'=>$user_name,'email'=>$user_email,'activate_link'=>$activateLink, 'admin_users_email'=>$admin_users_email), 
			function($message) use ($admin_users_email, $user_email,$user_name)
			{
			$message->from($admin_users_email);
			$message->to($user_email, $user_name)->subject('Welcome to Dealers Direct');
			});

			if( ! $sent) 
			{
			echo 'something went wrong!! Mail not sent.'; 
			
			}
			else
			{
			echo 'Registration completed successfully.Please login with your details to your account.'; 
			
			}
    }
    public function AddStyle($id=null){
        echo $id=base64_decode($id);
        
        echo "<pre>";
        
        $RequestQueue=RequestQueue::where('id', $id)->with('makes','models')->first();
        $Caryear=Caryear::where('make_id', $RequestQueue->make_id)->where('carmodel_id', $RequestQueue->carmodel_id)->where('year', $RequestQueue->year)->with('makes','models')->first();
        print_r($Caryear->year_id);
        echo "<pre>";
        print_r($Caryear->make_id);
        echo "<pre>";
        print_r($Caryear->carmodel_id);
        echo "<pre>";

        echo $count=Style::where('year_id',$Caryear->year_id)->where('make_id',$Caryear->make_id)->where('carmodel_id',$Caryear->carmodel_id)->count();
        if($count==0){
            $url='https://api.edmunds.com/api/vehicle/v2/'.$RequestQueue->makes->nice_name.'/'.$RequestQueue->models->nice_name.'/'.$Caryear->year.'?fmt=json&api_key=zxccg2zf747xeqvmuyxk9ht2';
            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            curl_close($ch);
            $resuls=json_decode($result, true);
            foreach ($resuls['styles'] as $styles) {
                        $Style['year_id'] =$Caryear->year_id;
                        $Style['make_id'] =$Caryear->make_id;
                        $Style['carmodel_id'] =$Caryear->carmodel_id;
                        $Style['style_id'] =$styles['id'];
                        $Style['name'] =$styles['name'];
                        $Style['body'] =$styles['submodel']['body'];
                        $Style['trim'] =$styles['trim'];
                        $Style['submodel'] =json_encode($styles['submodel'],true);
                        Style::create($Style);
                    }

        }

    }

}
