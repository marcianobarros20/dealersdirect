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
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use Hash;
use App\Helper\helpers;


class HomeController extends BaseController
{
    
    public function __construct() 
    {
        parent::__construct();

        view()->share('order_class','active');
        
    }



    public function index()
    {
        //

        

        return view('front.home.index');

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
    public function RequestSuccess(){
        $guest_user=Session::get('guest_user');
        $RequestQueue = RequestQueue::find($guest_user);
        Session::forget('guest_user');
        return view('front.home.request_success',compact('RequestQueue'),array('title'=>'DEALERSDIRECT | Request Success'));

    }
    public function ClientRegister(){

        
        $guest_user=Request::input('id');
        

        $tamo=time()."CLIENT";
        $hashpassword = Hash::make(Request::input('password'));
        $Client['first_name'] =Request::input('fname');
        $Client['last_name'] =Request::input('lname');
        $Client['phone'] =Request::input('phone');
        $Client['email'] =Request::input('email');
        $Client['password'] =$hashpassword;
        $Client['code_number'] =$tamo;
        
        $Client_row=Client::create($Client);
        $lastinsertedId = $Client_row->id;

        $RequestQueue = RequestQueue::find($guest_user);
        $RequestQueue->fname=Request::input('fname');
        $RequestQueue->lname=Request::input('lname');
        $RequestQueue->phone=Request::input('phone');
        $RequestQueue->email=Request::input('email');
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
}
