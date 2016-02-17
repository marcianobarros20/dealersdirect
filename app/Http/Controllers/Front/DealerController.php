<?php

namespace App\Http\Controllers\Front;
use App\Model\Make;          /* Model name*/
use App\Model\Dealer;          /* Model name*/
use App\Model\DealerMakeMap;          /* Model name*/
use App\Model\RequestDealerLog;          /* Model name*/
use App\Model\Carmodel;          /* Model name*/
use App\Model\RequestQueue;          /* Model name*/
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
    public function __construct(){
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
    public function index(){
            $obj = new helpers();

            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }else{
            return redirect('dealer-dashboard');
            }
    }
    public function signin(){
        
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
            // echo Session::get('dealer_userid');
            // echo Session::get('dealer_email');
            // echo Session::get('dealer_name');

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
    public function signout(){
            Session::forget('dealer_userid');
            Session::forget('dealer_email');
            Session::forget('dealer_name');

            return redirect('dealer-signin');
    }
    public function requestList(){
            $dealer_userid=Session::get('dealer_userid');
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $dealer_userid)->with('makes','requestqueue')->get();
            $requestqueuex=array();
            foreach ($RequestDealerLog as $key=> $value) {
                    $requestqueuex[$key]['id']=$value->id;
                    $requestqueuex[$key]['status']=$value->status;
                    $requestqueuex[$key]['make']=$value->makes->name;
                    $mid=$value->requestqueue->carmodel_id;
                    $Carmodel=Carmodel::where("id",$mid)->first();
                    $requestqueuex[$key]['model']=$Carmodel->name;
                    $requestqueuex[$key]['year']=$value->requestqueue->year;
                    $requestqueuex[$key]['conditions']=$value->requestqueue->condition;
                    $requestqueuex[$key]['total']=$value->requestqueue->total_amount;
                    $requestqueuex[$key]['monthly']=$value->requestqueue->monthly_amount;

                    
                        if($value->status==1){
                            $fn=$value->requestqueue->fname;
                            $ln=$value->requestqueue->lname;
                            $em=$value->requestqueue->email;
                            $ph=$value->requestqueue->phone;
                            $requestqueuex[$key]['cfname']=self::maskcreate($fn);
                            $requestqueuex[$key]['lem']=self::maskcreate($ln);
                            $requestqueuex[$key]['cemail']=self::maskcreate($em);
                            $requestqueuex[$key]['cphone']=self::maskcreate($ph);
                        }
            }
            return view('front.dealer.dealer_request_list',compact('requestqueuex'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
    }
    public function maskcreate($maskval){
            $mm=strlen($maskval)-2;
            $mask = preg_replace ( "/\S/", "X", $maskval );
            $mask = substr ( $mask, 1, $mm );
            $str = substr_replace ( $maskval, $mask, 1, $mm );
            return ucfirst($str);
    }
    public function requestDetail($id=null){
            $RequestDealerLog=RequestDealerLog::where('id', $id)->with('makes','requestqueue')->first();
            $requestqueuex['id']=$RequestDealerLog->id;
            $requestqueuex['status']=$RequestDealerLog->status;
            $requestqueuex['make']=$RequestDealerLog->makes->name;
            $mid=$RequestDealerLog->requestqueue->carmodel_id;
            $Carmodel=Carmodel::where("id",$mid)->first();
            $requestqueuex['model']=$Carmodel->name;
            $requestqueuex['year']=$RequestDealerLog->requestqueue->year;
            $requestqueuex['conditions']=$RequestDealerLog->requestqueue->condition;
            $requestqueuex['total']=$RequestDealerLog->requestqueue->total_amount;
            $requestqueuex['monthly']=$RequestDealerLog->requestqueue->monthly_amount;
            $requestqueuex['cat']=$RequestDealerLog->requestqueue->created_at;
                if($RequestDealerLog->status==1){
                    $fn=$RequestDealerLog->requestqueue->fname;
                    $ln=$RequestDealerLog->requestqueue->lname;
                    $em=$RequestDealerLog->requestqueue->email;
                    $ph=$RequestDealerLog->requestqueue->phone;
                    $requestqueuex['cfname']=self::maskcreate($fn);
                    $requestqueuex['lem']=self::maskcreate($ln);
                    $requestqueuex['cemail']=self::maskcreate($em);
                    $requestqueuex['cphone']=self::maskcreate($ph);
                }
            //print_r($requestqueuex);
            return view('front.dealer.dealer_request_details',compact('requestqueuex'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
    }
    public function DealerMakeList(){
        $dealer_userid=Session::get('dealer_userid');
        $DealerMakeMap=DealerMakeMap::where('dealer_id', $dealer_userid)->with('makes')->get();
        // echo "<pre>";
        // print_r($DealerMakeMap);
        return view('front.dealer.dealer_make_list',compact('DealerMakeMap'),array('title'=>'DEALERSDIRECT | Dealers Make'));
    }
    public function DealerMakeAdd(){
        $dealer_userid=Session::get('dealer_userid');
        $DealerMakeMap=DealerMakeMap::where('dealer_id', $dealer_userid)->distinct()->lists('make_id');
        
        $Make=Make::whereNotIn('id', $DealerMakeMap)->lists('name','id');
        return view('front.dealer.dealer_make_add',compact('Make'),array('title'=>'DEALERSDIRECT | Dealers Add Make'));
    }
    public function DealerAddMake(){
        $dealer_userid=Session::get('dealer_userid');
        $make=Request::input('agree');
        if(isset($make)){
            foreach ($make as $key => $value) {
                $DealerMakeMap['dealer_id']=$dealer_userid;
                $DealerMakeMap['make_id']=$value;
                DealerMakeMap::create($DealerMakeMap);
                $RequestQueue_row=RequestQueue::where('make_id', '=', $value)->get();
                if(isset($RequestQueue_row)){
                    
                    foreach ($RequestQueue_row as $rqueue) {
                        $RequestDealerLog['dealer_id']=$dealer_userid;;
                        $RequestDealerLog['request_id']=$rqueue->id;
                        $RequestDealerLog['make_id']=$rqueue->make_id;
                        $RequestDealerLog['status']=1;
                        RequestDealerLog::create($RequestDealerLog);
                    }
                }
            }
        }
        return redirect('dealer/dealer_make');
    }
    public function profile(){
       $dealer_userid=Session::get('dealer_userid');
       $Dealer = Dealer::where('id', $dealer_userid)->first();
       return view('front.dealer.dealer_profile',compact('Dealer'),array('title'=>'DEALERSDIRECT | Dealers Add Make'));
       //print_r($Dealer);

    }
    public function ProfileEditDetails(){
        $dealer_userid=Session::get('dealer_userid');
        $fname=Request::input('fname');
        $lname=Request::input('lname');
        $Dealer = Dealer::find($dealer_userid);
        $Dealer->first_name = $fname;
        $Dealer->last_name = $lname;
        $Dealer->save();
        $nam=ucfirst($fname)." ".ucfirst($lname);
        Session::forget('dealer_name');
        Session::put('dealer_name', $nam);
        Session::flash('message', 'Profile Details Successfully Changed'); 
        return redirect('/dealer/profile');
    }
    public function ProfileEditPassword(){
        $dealer_userid=Session::get('dealer_userid');
        
        $hashpassword = Hash::make(Request::input('password'));
        $Dealer = Dealer::find($dealer_userid);
        $Dealer->password = $hashpassword;
        
        $Dealer->save();
        Session::flash('message', 'Password Successfully Changed'); 
       
        return redirect('/dealer/profile');
    }
}
