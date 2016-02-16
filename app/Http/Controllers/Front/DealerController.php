<?php

namespace App\Http\Controllers\Front;
use App\Model\Make;          /* Model name*/
use App\Model\Dealer;          /* Model name*/
use App\Model\DealerMakeMap;          /* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Input;
//use Illuminate\Support\Facades\Session;
use Session;
use Illuminate\Support\Facades\Request;
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use App\Helper\helpers;


class DealerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() 
    {
        parent::__construct();
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
        {
            $dealerlogin=0;
        }
        else
        {
            $dealerlogin=1;
        }
        
        view()->share('dealerlogin',$dealerlogin);
        view()->share('obj',$obj);
    }
    public function index()
    {
       $obj = new helpers();

        if(!$obj->checkDealerLogin())
        {
            return redirect('dealer-signin');
        }else{
            return redirect('dealer-dashboard');
        }

    }
    


    public function signin()
    {
        
       $obj = new helpers();
        if($obj->checkDealerLogin())
        {
            
            return redirect('dealer-dashboard');
        }
        if(Request::isMethod('post'))
        {
           $email = Request::input('email');
            $password = Request::input('password');
            $Dealer = Dealer::where('email', $email)->first();
            if($Dealer!=""){

                $Dealer_pass = $Dealer->password;
                // check for password
                if(Hash::check($password, $Dealer_pass)){

                   
                    
                    $nam=ucfirst($Dealer->first_name)." ".ucfirst($Dealer->last_name);
                    Session::put('dealer_userid', $Dealer->id);
                    Session::put('dealer_email', $Dealer->email);
                    Session::put('dealer_name', $nam);
                    
                    
                    Session::save();

                    return redirect('dealer-dashboard');

                }
                else{
                        Session::flash('error', 'Email and password does not match.'); 
                        return redirect('dealer-signin');
                    }
               
            }
            else{
                    Session::flash('error', 'Email and password does not match.'); 
                    return redirect('dealer-signin');
            }

        }

        return view('front.dealer.dealer_signin',array('title'=>'DEALERSDIRECT | Dealers Signin'));
    }
    
public function dashboard(){
    //print_r($_SESSION);
    echo Session::get('dealer_userid');
    echo Session::get('dealer_email');
    echo Session::get('dealer_name');
    
return view('front.dealer.dealer_dashboard',array('title'=>'DEALERSDIRECT | Dealers Signin'));
}


    public function signup(){
        $obj = new helpers();
        if($obj->checkDealerLogin())
        {
            return redirect('dealer-dashboard');
        }
        $variable=Make::all();
        $Makes=array();
        foreach ($variable as $key => $value) {
            $Makes[$value->id]=$value->name;
        }
        return view('front.dealer.dealer_signup',compact('Makes'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
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
}
