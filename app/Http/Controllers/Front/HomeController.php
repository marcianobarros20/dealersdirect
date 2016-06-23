<?php

namespace App\Http\Controllers\Front;


use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Input; /* For input */
use Validator;
use App\Model\Make;          /* Model name*/
use App\Model\Carmodel;          /* Model name*/
use App\Model\RequestQueue;          /* Model name*/
use App\Model\Client;          /* Model name*/
use App\Model\Loan;            /* Model name*/
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use Hash;
use Mail;
use App\Helper\helpers;


class HomeController extends BaseController
{
    
    public function __construct() 
    {
        parent::__construct();

        view()->share('order_class','active');
        
    }
    public function CheckLogin(){
            $client=Session::get('client_userid');
            if(isset($client)){
                return $client;
            }else{
                return 0;
            }
            
    }


    public function index()
    {
        
        //echo "something";
        $client=self::CheckLogin();
        if($client!=0){
             $client;
            



        }else{
            
        }

         $loan_details = Loan::all();

           
        
        return view('front.home.index',compact('client', 'loan_details'),array('title'=>'DEALERSDIRECT','typex'=>'home'));

    }
    public function services(){
        $client=self::CheckLogin();
        if($client!=0){
             $client;
        }else{
            
        }
        
        return view('front.home.services',compact('client'),array('title'=>'DEALERSDIRECT Services','typex'=>'services'));
    }
    public function ContactUs(){
        $client=self::CheckLogin();
        if($client!=0){
             $client;
        }else{
            
        }
       
        return view('front.home.contact_us',compact('client'),array('title'=>'DEALERSDIRECT Contact-Us','typex'=>'contact-us'));
    }
    public function Contact(){
        print_r(Request::input());
        $name=Request::input('name');
        $email=Request::input('email');
        $phone=Request::input('phone');
        $subject=Request::input('subject');
        $details=Request::input('details');
        $admin_users_email="work@tier5.us";

        $sent = Mail::send('front.email.contactUs', array('name'=>$name,'email'=>$email,'phone'=>$phone, 'subject'=>$subject,'details'=>$details), 
            function($message) use ($admin_users_email,$email,$name)
            {
            $message->from($admin_users_email);
            $message->to($admin_users_email, "DealersDirect")->subject('Contact From DEALERSDIRECT');
            });
        Session::flash('message', 'Your Message Has Been Sent To The Dealers Direct Admin We Will Get Back To You Soon'); 
                    return redirect('/contact-us');
            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function RequestSuccess($id=null){
        $guest_user=base64_decode($id);
        
        $RequestQueue = RequestQueue::find($guest_user);
        //Session::forget('guest_user');
        $client=0;
        return view('front.home.request_success',compact('client','RequestQueue'),array('title'=>'DEALERSDIRECT | Request Success'));

    }
    public function ClientRegister(){
        $guest_user=Request::input('id');
        

        $tamo=time()."CLIENT";
        $hashpassword = Hash::make(Request::input('password'));
        $Client['first_name'] =Request::input('fname');
        $Client['last_name'] =Request::input('lname');
        $Client['phone'] =Request::input('phone');
        $Client['email'] =Request::input('email');
        $Client['zip'] =Request::input('zip');
        $Client['password'] =$hashpassword;
        $Client['code_number'] =$tamo;
        
        $Client_row=Client::create($Client);
        $lastinsertedId = $Client_row->id;

        $RequestQueue = RequestQueue::find($guest_user);
        $RequestQueue->fname=Request::input('fname');
        $RequestQueue->lname=Request::input('lname');
        $RequestQueue->phone=Request::input('phone');
        $RequestQueue->email=Request::input('email');
        $RequestQueue->zip=Request::input('zip');
        $RequestQueue->type=1;
        $RequestQueue->client_id=$lastinsertedId;
        $RequestQueue->save();
        $namx=ucfirst(Request::input('fname'))." ".ucfirst(Request::input('lname'));
        $emailx=Request::input('email');
        Session::put('client_userid', $lastinsertedId);
        Session::put('client_email', $emailx);
        Session::put('client_name', $namx);
        Session::save();
        return redirect('client-dashboard');


    }




    public function trunck(){
        DB::table('bid_acceptance_log')->truncate();
        DB::table('bid_image')->truncate();
        DB::table('bid_queue')->truncate();
        DB::table('bid_stop_log')->truncate();
        DB::table('clients')->truncate();
        DB::table('dealer_details')->truncate();
        DB::table('dealers')->delete();
        DB::table('dealers_makes_map')->delete();
        DB::table('edmunds_make_model_year_images')->truncate();
        DB::table('edmunds_style_images')->truncate();
        DB::table('request_queue')->delete();
        DB::table('request_dealer_log')->delete();
        DB::table('tradein_request_queue')->truncate();
        DB::table('block_bid_log')->truncate();
        DB::table('bid_stop_log_details')->truncate();

    }
}
