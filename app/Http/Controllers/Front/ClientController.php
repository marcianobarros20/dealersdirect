<?php

namespace App\Http\Controllers\Front;

use App\Model\Make;                                         /* Model name*/
use App\Model\Dealer;                                       /* Model name*/
use App\Model\DealerMakeMap;                                /* Model name*/
use App\Model\RequestDealerLog;                             /* Model name*/
use App\Model\Carmodel;                                     /* Model name*/
use App\Model\RequestQueue;                                 /* Model name*/
use App\Model\Client;                                       /* Model name*/
use App\Model\Caryear;                                      /* Model name*/
use App\Model\Style;                                        /* Model name*/
use App\Model\RequestStyleEngineTransmissionColor;          /* Model name*/
use App\Model\Engine;                                       /* Model name*/
use App\Model\Transmission;                                 /* Model name*/
use App\Model\Color;                                        /* Model name*/
use App\Model\BidQueue;                                     /* Model name*/
use App\Model\EdmundsMakeModelYearImage;                    /* Model name*/
use App\Model\EdmundsStyleImage;                            /* Model name*/
use App\Model\TradeinRequest;                               /* Model name*/
use App\Model\LeadContact;                               /* Model name*/

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
            $client=Session::get('client_userid');
			return view('front.client.client_dashboard',compact('client'),array('title'=>'DEALERSDIRECT | Client Dashboard'));
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

            // validating input type is email or not
            
          /*  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                Session::flash('error', 'Invalid Email Format');
                return redirect('client-signin'); 
            }*/
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
        $client=0;
        return view('front.client.client_signin',compact('client'),array('title'=>'DEALERSDIRECT | Clients Signin'));
    }
    public function profile(){
    	$obj = new helpers();
			if(!$obj->checkClientLogin())
			{
			return redirect('client-signin');
			}
       	$client_userid=Session::get('client_userid');
       	$Client = Client::where('id', $client_userid)->first();
        $client=Session::get('client_userid');
       	return view('front.client.client_profile',compact('Client','client'),array('title'=>'DEALERSDIRECT | Clients Profile'));
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
        $zip=Request::input('zip');
        $Client = Client::find($client_userid);
        $Client->first_name = $fname;
        $Client->last_name = $lname;
        $Client->phone = $phone;
        $Client->zip = $zip;
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
            $RequestQueue=RequestQueue::where('client_id', $client_userid)->with('makes','models','clients','bids','options','options.styles','options.engines','options.transmission','options.excolor','options.incolor','options.edmundsimage','trade_ins','trade_ins.makes','trade_ins.models')->get();
            foreach ($RequestQueue as $kei => $RQ) {
                

                $countimg=EdmundsMakeModelYearImage::where('make_id',$RQ->make_id)->where('model_id',$RQ->carmodel_id)->where('year_id',$RQ->year)->groupBy('title')->count();
                if($countimg!=0){
                  $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RQ->make_id)->where('model_id',$RQ->carmodel_id)->where('year_id',$RQ->year)->groupBy('local_path_smalll')->get();
                  $RequestQueue[$kei]['imx']=$EdmundsMakeModelYearImage;  
                }else{
                    $RequestQueue[$kei]['imx']="";
                }
                
            }
            $client=Session::get('client_userid');
            return view('front.client.client_request_list',compact('client','RequestQueue'),array('title'=>'DEALERSDIRECT | Client Request'));
    }
    public function requestDetail($id=null){
            $obj = new helpers();
            if(!$obj->checkClientLogin())
            {
                return redirect('client-signin');
            }
            $client_userid=Session::get('client_userid');
            $id=base64_decode($id);
            if(Session::get('filter_sec')){
                $fill=Session::get('filter_sec');
            }
            else{
                $fill=1;
            }
            $RequestQueue=RequestQueue::where('id', $id)->with('makes','models','clients','bids','options','options.styles','options.engines','options.transmission','options.excolor','options.incolor','options.edmundsimage','trade_ins','trade_ins.makes','trade_ins.models')->first();
            $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RequestQueue->make_id)->where('model_id',$RequestQueue->carmodel_id)->where('year_id',$RequestQueue->year)->groupBy('local_path_big')->get();
            $EMMYIcount=EdmundsMakeModelYearImage::where('make_id',$RequestQueue->make_id)->where('model_id',$RequestQueue->carmodel_id)->where('year_id',$RequestQueue->year)->groupBy('title')->count();
            $CheckForLeadContact=LeadContact::where('request_id', $id)->first();
            
            $client=Session::get('client_userid');
            return view('front.client.client_request_details',compact('client','EdmundsMakeModelYearImage','RequestQueue','fill','EMMYIcount','CheckForLeadContact'),array('title'=>'DEALERSDIRECT | Client Request Details'));
    }
    public function UpdateBudget($id=Null){
        $RequestQueue=RequestQueue::where('id', $id)->first();
    return \View::make("front.client.client_update_budget",compact('RequestQueue'));
    }
    public function UpdateBudgetPost(){
        $id=Request::input('req_id');
        $totalvalue=Request::input('totalvalue');
        $monthlyvalue=Request::input('monthlyvalue');
        $update_client_budget=RequestQueue::find($id);
        $update_client_budget->monthly_amount=$monthlyvalue;
        $update_client_budget->total_amount=$totalvalue;
        $update_client_budget->update();
        return \Redirect::back();
    }

    public function contactList(){
        $obj = new helpers();
            if(!$obj->checkClientLogin())
            {
                return redirect('client-signin');
            }
             $client_userid=Session::get('client_userid');
            
            $get_request_ids = array();
            
            $get_request_ids=RequestQueue::where('client_id','=',$client_userid)->lists('id');
            $leadssec=LeadContact::whereIn('request_id',$get_request_ids)->with('dealer_info','dealer')->groupBy('dealer_id')->get();
            
            $newarray=array();
            foreach ($leadssec as $keyx => $lead) {

                $secfun=LeadContact::whereIn('request_id',$get_request_ids)->where('dealer_id',$lead->dealer_id)
                ->with('request_details','request_details.makes','request_details.models','dealer_info')
                ->get();

                

                foreach ($secfun as $key => $value) {
                   
                   $newarray[$lead->dealer_id][$key]['request_id']=$value->request_id;
                   $newarray[$lead->dealer_id][$key]['make']= $value->request_details->makes->name;
                   $newarray[$lead->dealer_id][$key]['model']= $value->request_details->models->name;
                   $newarray[$lead->dealer_id][$key]['year']= $value->request_details->year;
                   $newarray[$lead->dealer_id][$key]['condition']= $value->request_details->condition;
                   $newarray[$lead->dealer_id][$key]['totalvalue']= $value->request_details->total_amount;
                   $newarray[$lead->dealer_id][$key]['monthlyvalue']= $value->request_details->monthly_amount;
                   $newarray[$lead->dealer_id][$key]['tradein']= $value->request_details->trade_in;
                   $newarray[$lead->dealer_id][$key]['carImages']=EdmundsMakeModelYearImage::where('make_id',$value->request_details->models->make_id)->where('model_id',$value->request_details->carmodel_id)->where('year_id',$value->request_details->year)->groupBy('model_id')->first();
                   $newarray[$lead->dealer_id][$key]['dealer_id']=$value->dealer_info->dealer_id;
                }
                 
            }
            
            return view('front.client.client_contact_list',compact('newarray','leadssec'),array('title'=>'DEALERSDIRECT | Client Contacts'));
            }
            
            public function contactDetails($id=null){
                $obj = new helpers();
            if(!$obj->checkClientLogin())
                {
                return redirect('client-signin');
                }
                $client_userid=Session::get('client_userid');
            $id=base64_decode($id);
            if(Session::get('filter_sec')){
                $fill=Session::get('filter_sec');
            }
            else{
                $fill=1;
            }
            $RequestQueue=RequestQueue::where('id', $id)->with('makes','models','clients','bids','options','options.styles','options.engines','options.transmission','options.excolor','options.incolor','options.edmundsimage','trade_ins','trade_ins.makes','trade_ins.models')->first();
            $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RequestQueue->make_id)->where('model_id',$RequestQueue->carmodel_id)->where('year_id',$RequestQueue->year)->groupBy('local_path_big')->get();
            $EMMYIcount=EdmundsMakeModelYearImage::where('make_id',$RequestQueue->make_id)->where('model_id',$RequestQueue->carmodel_id)->where('year_id',$RequestQueue->year)->groupBy('title')->count();

            //die('this');
            $client=Session::get('client_userid');
            return view('front.client.client_contact_details',compact('client','EdmundsMakeModelYearImage','RequestQueue','fill','EMMYIcount'),array('title'=>'DEALERSDIRECT | Client Contact Details'));

            }
            
            

            public function testmailnew(){
			$user_name = "PRODIPTO";
			$user_email = "hello@tier5.us";
			$admin_users_email="hello@tier5.us";
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
        $id=base64_decode($id);
        $RequestQueue=RequestQueue::where('id', $id)->with('makes','models')->first();
        $Caryear=Caryear::where('make_id', $RequestQueue->make_id)->where('carmodel_id', $RequestQueue->carmodel_id)->where('year', $RequestQueue->year)->with('makes','models')->first();
       $urlxx='https://api.edmunds.com/api/vehicle/v2/'.$RequestQueue->makes->nice_name.'/'.$RequestQueue->models->nice_name.'/'.$Caryear->year.'/styles?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
        $count=Style::where('year_id',$Caryear->year_id)->where('make_id',$Caryear->make_id)->where('carmodel_id',$Caryear->carmodel_id)->count();
            if($count==0){
                $url='https://api.edmunds.com/api/vehicle/v2/'.$RequestQueue->makes->nice_name.'/'.$RequestQueue->models->nice_name.'/'.$Caryear->year.'/styles?view=full&fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
                
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
                    $Style['price'] =json_encode($styles['price'],true);
                    Style::create($Style);
                }
            }
            $Stylenew=Style::where('year_id', $Caryear->year_id)->get();
            $newrequest_id=base64_encode($id);
            $client=Session::get('client_userid');


            return view('front.client.client_add_style',compact('newrequest_id','client','Stylenew','RequestQueue'),array('title'=>'DEALERSDIRECT | Client Add Style'));
    }
    public function AddEngine($id=null){
        $id=base64_decode($id);
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("id",$id)->first();
        $RequestQueue=RequestQueue::where('id', $RequestStyleEngineTransmissionColor->requestqueue_id)->with('makes','models')->first();
        $count=Engine::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->count();
        if($count==0){
                $url='https://api.edmunds.com/api/vehicle/v2/styles/'.$RequestStyleEngineTransmissionColor->style_id.'/engines?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $result = curl_exec($ch);
                curl_close($ch);
                $resuls=json_decode($result, true);
                foreach ($resuls['engines'] as $value) {
                    
                    if(isset($value['compressionRatio'])){$compressionRatio=$value['compressionRatio'];}else{$compressionRatio="";}
                    if(isset($value['cylinder'])){$cylinder=$value['cylinder'];}else{$cylinder="";}
                    if(isset($value['size'])){$size=$value['size'];}else{$size="";}
                    if(isset($value['displacement'])){$displacement=$value['displacement'];}else{$displacement="";}
                    if(isset($value['configuration'])){$configuration=$value['configuration'];}else{$configuration="";}
                    if(isset($value['fuelType'])){$fuelType=$value['fuelType'];}else{$fuelType="";}
                    if(isset($value['horsepower'])){$horsepower=$value['horsepower'];}else{$horsepower="";}
                    
                    if(isset($value['torque'])){$torque=$value['torque'];}else{$torque="";}
                    if(isset($value['totalValves'])){$totalValves=$value['totalValves'];}else{$totalValves="";}
                    if(isset($value['type'])){$type=$value['type'];}else{$type="";}
                    if(isset($value['code'])){$code=$value['code'];}else{$code="";}
                    if(isset($value['compressorType'])){$compressorType=$value['compressorType'];}else{$compressorType="";}
                    if(isset($value['rpm'])){$rpm=json_encode($value['rpm'],true);}else{$rpm="";}
                    if(isset($value['valve'])){$valve=json_encode($value['valve'],true);}else{$valve="";}

                    if($value['availability']!="OPTIONAL"){
                        $Engine['requestqueue_id']=$id;
                        $Engine['style_id']=$RequestStyleEngineTransmissionColor->style_id;
                        $Engine['engine_id']=$value['id'];
                        $Engine['name']=$value['name'];
                        $Engine['equipmentType']=$value['equipmentType'];
                        $Engine['compressionRatio']=$compressionRatio;
                        $Engine['cylinder']=$cylinder;
                        $Engine['size']=$size;
                        $Engine['displacement']=$displacement;
                        $Engine['configuration']=$configuration;
                        $Engine['fuelType']=$fuelType;
                        $Engine['horsepower']=$horsepower;
                        $Engine['torque']=$torque;
                        $Engine['totalValves']=$totalValves;
                        $Engine['type']=$type;
                        $Engine['code']=$code;
                        $Engine['compressorType']=$compressorType;
                        $Engine['rpm']=$rpm;
                        $Engine['valve']=$valve;
                        Engine::create($Engine);
                    }
                }
        }
        $counttransmission=Transmission::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->count();
        if($counttransmission==0){
                $url='https://api.edmunds.com/api/vehicle/v2/styles/'.$RequestStyleEngineTransmissionColor->style_id.'/transmissions?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $resulttransmission = curl_exec($ch);
                curl_close($ch);
                $resulttransmissions=json_decode($resulttransmission, true);
                
                foreach ($resulttransmissions['transmissions'] as $transmissions) {

                        $Transmission['requestqueue_id']=$id;
                        $Transmission['style_id']=$RequestStyleEngineTransmissionColor->style_id;
                        $Transmission['transmission_id']=$transmissions['id'];
                        $Transmission['name']=$transmissions['name'];
                        $Transmission['equipmentType']=$transmissions['equipmentType'];
                        $Transmission['transmissionType']=$transmissions['transmissionType'];
                        $Transmission['numberOfSpeeds']=$transmissions['numberOfSpeeds'];
                        Transmission::create($Transmission);
                }
        }
        $countcolor=Color::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->count();
        if($countcolor==0){
                $url='https://api.edmunds.com/api/vehicle/v2/styles/'.$RequestStyleEngineTransmissionColor->style_id.'/colors?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $resultcolor = curl_exec($ch);
                curl_close($ch);
                $resultcolors=json_decode($resultcolor, true);
                
                foreach ($resultcolors['colors'] as $color) {
                    
                    if(isset($color['category'])){$category=$color['category'];}else{$category="";}
                    if(isset($color['name'])){$cname=$color['name'];}else{$cname="";}
                    if(isset($color['manufactureOptionName'])){$manufactureOptionName=$color['manufactureOptionName'];}else{$manufactureOptionName="";}
                    if(isset($color['colorChips']['primary']['hex'])){$hex=$color['colorChips']['primary']['hex'];}else{$hex="";}
                    if(isset($color['colorChips'])){$colorChips=json_encode($color['colorChips'],true);}else{$colorChips="";}

                        $Color['requestqueue_id']=$id;
                        $Color['style_id']=$RequestStyleEngineTransmissionColor->style_id;
                        $Color['color_id']=$color['id'];
                        $Color['category']=$category;
                        $Color['name']=$cname;
                        $Color['manufactureOptionName']=$manufactureOptionName;
                        $Color['hex']=$hex;
                        $Color['rgb']=$colorChips;
                        Color::create($Color);
                    
                }
        }

        $Engine=Engine::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->get();

        $newrequest_id=base64_encode($RequestStyleEngineTransmissionColor->requestqueue_id);
        $countnum=$RequestStyleEngineTransmissionColor->count;
        $client=Session::get('client_userid');
        return view('front.client.client_add_engine',compact('newrequest_id','client','Engine','RequestQueue','countnum'),array('title'=>'DEALERSDIRECT | Client Add Engine'));
    }
    public function AddTransmission($id=null){
        $id=base64_decode($id);
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("id",$id)->first();
        $RequestQueue=RequestQueue::where('id', $RequestStyleEngineTransmissionColor->requestqueue_id)->with('makes','models')->first();
        $Transmission=Transmission::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->get();

        $newrequest_id=base64_encode($RequestStyleEngineTransmissionColor->requestqueue_id);
        $countnum=$RequestStyleEngineTransmissionColor->count;
        $client=Session::get('client_userid');
        return view('front.client.client_add_transmission',compact('newrequest_id','client','Transmission','RequestQueue','countnum'),array('title'=>'DEALERSDIRECT | Client Add Transmission'));
    }
    public function AddColorExterior($id=null){
        $id=base64_decode($id);
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("id",$id)->first();
        $RequestQueue=RequestQueue::where('id', $RequestStyleEngineTransmissionColor->requestqueue_id)->with('makes','models')->first();
        $Color=Color::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->where('category','Exterior')->get();

        $newrequest_id=base64_encode($RequestStyleEngineTransmissionColor->requestqueue_id);
        $countnum=$RequestStyleEngineTransmissionColor->count;
        if($countnum==0){
            return redirect('request_detail/'.$newrequest_id);
        }
        $client=Session::get('client_userid');
        return view('front.client.client_add_exterior_color',compact('newrequest_id','client','Color','RequestQueue','countnum'),array('title'=>'DEALERSDIRECT | Client Add Exterior Color'));
    }
    public function AddColorInterior($id=null){
        $id=base64_decode($id);
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("id",$id)->first();
        $RequestQueue=RequestQueue::where('id', $RequestStyleEngineTransmissionColor->requestqueue_id)->with('makes','models')->first();
        
        $Color=Color::where('style_id',$RequestStyleEngineTransmissionColor->style_id)->where('category','Interior')->groupBy('name')->get();

        $newrequest_id=base64_encode($RequestStyleEngineTransmissionColor->requestqueue_id);
        $countnum=$RequestStyleEngineTransmissionColor->count;
        if($countnum==0){
            return redirect('request_detail/'.$newrequest_id);
        }
        $client=Session::get('client_userid');
        return view('front.client.client_add_interior_color',compact('newrequest_id','client','Color','RequestQueue','countnum'),array('title'=>'DEALERSDIRECT | Client Add Exterior Color'));
    }
    public function SigninClient(){
        $cachedata=Session::get('cachedata');
        
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
                    $RequestQueue['fname'] =$Client->first_name;
                    $RequestQueue['lname'] =$Client->last_name;
                    $RequestQueue['phone'] =$Client->phone;
                    $RequestQueue['type'] =1;
                    $RequestQueue['email'] =$Client->email;
                    $RequestQueue['client_id']=$Client->id;
                    $RequestQueue['im_type']=1;

                    if($cachedata['tradein']=="yes"){
                        $RequestQueue['trade_in']=1;
                        $TradeinRequest['make_id'] =$cachedata['trademake_search'];
                        $TradeinRequest['carmodel_id'] =$cachedata['trademodel_search'];
                        $TradeinRequest['condition'] =$cachedata['tradecondition_search'];
                        $TradeinRequest['year'] =$cachedata['tradeyear_search'];
                        $owe=Request::input('owe');
                            if(isset($cachedata['owe'])){
                                $TradeinRequest['owe'] =$cachedata['owe'];
                                $TradeinRequest['owe_amount'] =$cachedata['owe_amount'];

                            }
                        $TradeinRequest['im_type']=1;
                        $TradeinRequest['fname'] =$Client->first_name;
                        $TradeinRequest['lname'] =$Client->last_name;
                        $TradeinRequest['phone'] =$Client->phone;
                        $TradeinRequest['type'] =1;
                        $TradeinRequest['email'] =$Client->email;
                        $TradeinRequest['client_id']=$Client->id;
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

                    return redirect('client-dashboard');

                }
                else{
                        Session::flash('error', 'Email and password does not match.'); 
                        return redirect('signin-client');
                    }
               
            }
            else{
                    Session::flash('error', 'Email and password does not match.'); 
                    return redirect('signin-client');
            }
        }
        $client=0;
        return view('front.client.signin_client',compact('client'),array('title'=>'DEALERSDIRECT | Clients Signin'));

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
