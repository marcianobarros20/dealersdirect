<?php

namespace App\Http\Controllers\Front;
use App\Model\Make;                                         /* Model name*/
use App\Model\Dealer;                                       /* Model name*/
use App\Model\DealerMakeMap;                                /* Model name*/
use App\Model\RequestDealerLog;                             /* Model name*/
use App\Model\Carmodel;                                     /* Model name*/
use App\Model\RequestQueue;                                 /* Model name*/
use App\Model\RequestStyleEngineTransmissionColor;          /* Model name*/
use App\Model\BidQueue;                                     /* Model name*/
use App\Model\BidImage;                                     /* Model name*/
use App\Model\BidStopLogDetail;                             /* Model name*/
use App\Model\BidStopLog;                                   /* Model name*/
use App\Model\EdmundsMakeModelYearImage;                    /* Model name*/
use App\Model\EdmundsStyleImage;                            /* Model name*/
use App\Model\DealerDetail;                                 /* Model name*/
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
use Imagine\Image\Box;

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
                    Session::put('dealer_parent', $Dealer->parent_id);
                    
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
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
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
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            $dealer_userid=Session::get('dealer_userid');
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $dealer_userid)->with('makes','requestqueue')->get();
            $requestqueuex=array();
            foreach ($RequestDealerLog as $key=> $value) {
                    $requestqueuex[$key]['id']=$value->id;
                    $requestqueuex[$key]['status']=$value->status;
                    $requestqueuex[$key]['make']=$value->makes->name;
                    $requestqueuex[$key]['make_image']=$value->makes->image;
                    $requestqueuex[$key]['pstatus']=$value->requestqueue->status;
                    $requestqueuex[$key]['blocked']=$value->blocked;
                    $mid=$value->requestqueue->carmodel_id;
                    $Carmodel=Carmodel::where("id",$mid)->first();
                    $requestqueuex[$key]['model']=$Carmodel->name;
                    $requestqueuex[$key]['year']=$value->requestqueue->year;
                    $requestqueuex[$key]['conditions']=$value->requestqueue->condition;
                    $requestqueuex[$key]['total']=$value->requestqueue->total_amount;
                    $requestqueuex[$key]['monthly']=$value->requestqueue->monthly_amount;
                    $requestqueuex[$key]['im_type']=$value->requestqueue->im_type;
                    
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
                    if($value->requestqueue->im_type==1){
                        
                    $local_path_smalll=EdmundsMakeModelYearImage::where('make_id',$value->requestqueue->make_id)->where('model_id',$value->requestqueue->carmodel_id)->where('year_id',$value->requestqueue->year)->first();
                    $requestqueuex[$key]['img']=$local_path_smalll->local_path_smalll;
                    }
                    elseif ($value->requestqueue->im_type==2) {
                        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where('requestqueue_id',$value->requestqueue->id)->first();
                        $RequestStyleEngineTransmissionColor->style_id;
                        $EdmundsStyleImage=EdmundsStyleImage::where('style_id', $RequestStyleEngineTransmissionColor->style_id)->first();
                        $requestqueuex[$key]['img']=$EdmundsStyleImage->local_path_smalll;
                    }
                    else{
                        $local_path_smalll_count=EdmundsMakeModelYearImage::where('make_id',$value->requestqueue->make_id)->where('model_id',$value->requestqueue->carmodel_id)->where('year_id',$value->requestqueue->year)->count();
                        if($local_path_smalll_count!=0){
                            $local_path_smalll=EdmundsMakeModelYearImage::where('make_id',$value->requestqueue->make_id)->where('model_id',$value->requestqueue->carmodel_id)->where('year_id',$value->requestqueue->year)->first();
                            $requestqueuex[$key]['img']=$local_path_smalll->local_path_smalll;
                        }else{
                            $requestqueuex[$key]['img']="";
                        }
                        
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
        $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            $id=base64_decode($id);
            $RequestDealerLog=RequestDealerLog::where('id', $id)->with('makes','requestqueue')->first();
            $requestqueuex['id']=$RequestDealerLog->id;
            $requestqueuex['request_id']=$RequestDealerLog->request_id;
            $requestqueuex['status']=$RequestDealerLog->status;
            $requestqueuex['make']=$RequestDealerLog->makes->name;
            $requestqueuex['blocked']=$RequestDealerLog->blocked;
            $mid=$RequestDealerLog->requestqueue->carmodel_id;
            $Carmodel=Carmodel::where("id",$mid)->first();
            $requestqueuex['model']=$Carmodel->name;
            $requestqueuex['year']=$RequestDealerLog->requestqueue->year;
            $requestqueuex['conditions']=$RequestDealerLog->requestqueue->condition;
            $requestqueuex['total']=$RequestDealerLog->requestqueue->total_amount;
            $requestqueuex['monthly']=$RequestDealerLog->requestqueue->monthly_amount;
            $requestqueuex['cat']=$RequestDealerLog->requestqueue->created_at;
            $requestqueuex['im_type']=$RequestDealerLog->requestqueue->im_type;
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
                if($RequestDealerLog->requestqueue->im_type==1){
                        
                    $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RequestDealerLog->requestqueue->make_id)->where('model_id',$RequestDealerLog->requestqueue->carmodel_id)->where('year_id',$RequestDealerLog->requestqueue->year)->get();
                    
                    }elseif ($RequestDealerLog->requestqueue->im_type==2) {
                       $RequestStyleEngineTransmissionColor_isx=RequestStyleEngineTransmissionColor::where("requestqueue_id",$RequestDealerLog->requestqueue->id)->orderBy('id', 'desc')->first();
                       $RequestStyleEngineTransmissionColor_isx->style_id;
                         $EdmundsMakeModelYearImage=EdmundsStyleImage::where('style_id', $RequestStyleEngineTransmissionColor_isx->style_id)->get();
                    }
                    else{
                        $local_path_smalll_count=EdmundsMakeModelYearImage::where('make_id',$RequestDealerLog->requestqueue->make_id)->where('model_id',$RequestDealerLog->requestqueue->carmodel_id)->where('year_id',$RequestDealerLog->requestqueue->year)->count();
                        if($local_path_smalll_count!=0){
                            $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RequestDealerLog->requestqueue->make_id)->where('model_id',$RequestDealerLog->requestqueue->carmodel_id)->where('year_id',$RequestDealerLog->requestqueue->year)->get();
                            
                        }else{
                            $EdmundsMakeModelYearImage="";
                        }
                    }
            $BidQueue=BidQueue::where('requestqueue_id', $RequestDealerLog->request_id)->where('visable','=','1')->with('dealers')->orderBy('acc_curve_poin', 'asc')->get();
            $dealer_userid=Session::get('dealer_userid');
            $BidQueuecount=BidQueue::where('dealer_id', $dealer_userid)->where('requestqueue_id', $RequestDealerLog->request_id)->where('visable','=','1')->count();
             $RequestQueue_row=RequestQueue::where('id', $RequestDealerLog->request_id)->with('makes','trade_ins','trade_ins.makes','trade_ins.models')->first();
            $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$RequestDealerLog->request_id)->with('styles','engines','transmission','excolor','incolor')->get();
            return view('front.dealer.dealer_request_details',compact('RequestQueue_row','EdmundsMakeModelYearImage','BidQueue','BidQueuecount','requestqueuex','RequestStyleEngineTransmissionColor'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
    }
    public function DealerMakeList(){
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
        $dealer_userid=Session::get('dealer_userid');
        $DealerMakeMap=DealerMakeMap::where('dealer_id', $dealer_userid)->with('makes')->get();
        // echo "<pre>";
        // print_r($DealerMakeMap);
        return view('front.dealer.dealer_make_list',compact('DealerMakeMap'),array('title'=>'DEALERSDIRECT | Dealers Make'));
    }
    public function DealerMakeAdd(){
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
        $dealer_userid=Session::get('dealer_userid');
        $DealerMakeMap=DealerMakeMap::where('dealer_id', $dealer_userid)->distinct()->lists('make_id');
        
        $Make=Make::whereNotIn('id', $DealerMakeMap)->lists('name','id');
        return view('front.dealer.dealer_make_add',compact('Make'),array('title'=>'DEALERSDIRECT | Dealers Add Make'));
    }
    public function DealerAddMake(){
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
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
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
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
    public function postBid($id=null){
        $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            
                $dealid=Session::get('dealer_userid');
                $Dealerdet=Dealer::find($dealid);
                if($Dealerdet->status==0){
                    return redirect('/dealers/blocked');
                }else{
        
                        $id=base64_decode($id);
                        $RequestDealerLog=RequestDealerLog::where('id', $id)->with('makes','requestqueue')->first();
                        $requestqueuex['id']=$RequestDealerLog->id;
                        $requestqueuex['request_id']=$RequestDealerLog->request_id;
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

                        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$RequestDealerLog->request_id)->with('styles','engines','transmission','excolor','incolor')->get();
                        $RequestQueue_row=RequestQueue::where('id', $RequestDealerLog->request_id)->with('makes','trade_ins','trade_ins.makes','trade_ins.models')->first();
                        return view('front.dealer.post_bid',compact('requestqueuex','RequestStyleEngineTransmissionColor','RequestQueue_row'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
            }
    }
    public function editBid($id=null){
            $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
                    
                $dealid=Session::get('dealer_userid');
                $Dealerdet=Dealer::find($dealid);
                if($Dealerdet->status==0){
                return redirect('/dealers/blocked');
                }else{

                        $id=base64_decode($id);
                        $RequestDealerLog=RequestDealerLog::where('id', $id)->with('makes','requestqueue')->first();
                        $requestqueuex['id']=$RequestDealerLog->id;
                        $requestqueuex['request_id']=$RequestDealerLog->request_id;
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
                        
                        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$RequestDealerLog->request_id)->with('styles','engines','transmission','excolor','incolor')->get();
                        $dealer_userid=Session::get('dealer_userid');
                        $BidQueue=BidQueue::where("dealer_id",$dealer_userid)->where("requestqueue_id",$RequestDealerLog->request_id)->with('dealers','bid_image')->where('visable','=','1')->first();
                        $RequestQueue_row=RequestQueue::where('id', $RequestDealerLog->request_id)->with('makes','trade_ins','trade_ins.makes','trade_ins.models')->first();
                        return view('front.dealer.edit_bid',compact('requestqueuex','BidQueue','RequestStyleEngineTransmissionColor','RequestQueue_row'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
                    }
    }
    public function SaveBid(){
        $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }

            
            //dd(Request::input());
            //dd(Request::file('images'));
        // exit;
        $dealer_userid=Session::get('dealer_userid');
        $id=base64_encode(Request::input('request_id'));

        $BidQueue['requestqueue_id']=Request::input('id');
        $BidQueue['dealer_id']=$dealer_userid;
        $BidQueue['bid_id']=time()."BID";
        $BidQueue['total_amount']=Request::input('total_amount');
        $BidQueue['monthly_amount']=Request::input('monthly_amount');
        $BidQueue['details']=Request::input('details');
        $BidQueue['trade_in']=Request::input('trade_in');
        $BidQueue_row=BidQueue::create($BidQueue);
        $curve=self::CalculateBidCurve(Request::input('id'));
        $OtherImage=Request::file('images');
            if(Request::hasFile('images')){
                $this->obj = $obj;
                foreach ($OtherImage as $imgval) {
                    $extension =$imgval->getClientOriginalExtension();
                    $destinationPath = 'public/uploads/project/';   // upload path
                    $thumb_path = 'public/uploads/project/thumb/';
                    $medium = 'public/uploads/project/medium/';
                    $home_thumb_path = 'public/uploads/project/home_thumb/';
                    $extension =$imgval->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
                    $imgval->move($destinationPath, $fileName); // uploading file to given path

                    $this->obj->createThumbnail($fileName,260,167,$destinationPath,$thumb_path);
                    $this->obj->createThumbnail($fileName,850,455,$destinationPath,$medium);
                    $this->obj->createThumbnail($fileName,1920,900,$destinationPath,$home_thumb_path);
                    $BidImage['bid_id']=$BidQueue_row->id;
                    $BidImage['request_id']=$BidQueue_row->requestqueue_id;
                    $BidImage['dealer_id']=$BidQueue_row->dealer_id;
                    $BidImage['image']=$fileName;
                    BidImage::create($BidImage);

                }

            }
        return redirect('dealers/request_detail/'.$id);
    }
    public function SaveEditBid(){
        $obj = new helpers();
        

        $BidQueueprevious=BidQueue::where("id",Request::input('id'))->first();
        print_r($BidQueueprevious);
        $id=base64_encode(Request::input('request_id'));
        $BidQueue['requestqueue_id']=$BidQueueprevious->requestqueue_id;
        $BidQueue['dealer_id']=$BidQueueprevious->dealer_id;
        $BidQueue['bid_id']=time()."BID";
        $BidQueue['total_amount']=Request::input('total_amount');
        $BidQueue['monthly_amount']=Request::input('monthly_amount');
        $BidQueue['details']=Request::input('details');
        $BidQueue['trade_in']=Request::input('trade_in');
        $BidQueue_row=BidQueue::create($BidQueue);
        $OtherImage=Request::file('images');
            if(Request::hasFile('images')){
                $this->obj = $obj;
                foreach ($OtherImage as $imgval) {
                    $extension =$imgval->getClientOriginalExtension();
                    $destinationPath = 'public/uploads/project/';   // upload path
                    $thumb_path = 'public/uploads/project/thumb/';
                    $medium = 'public/uploads/project/medium/';
                    $home_thumb_path = 'public/uploads/project/home_thumb/';
                    $extension =$imgval->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
                    $imgval->move($destinationPath, $fileName); // uploading file to given path

                    $this->obj->createThumbnail($fileName,260,167,$destinationPath,$thumb_path);
                    $this->obj->createThumbnail($fileName,850,455,$destinationPath,$medium);
                    $this->obj->createThumbnail($fileName,1920,900,$destinationPath,$home_thumb_path);
                    $BidImage['bid_id']=$BidQueue_row->id;
                    $BidImage['request_id']=$BidQueue_row->requestqueue_id;
                    $BidImage['dealer_id']=$BidQueue_row->dealer_id;
                    $BidImage['image']=$fileName;
                    BidImage::create($BidImage);

                }

            }
            $preimg=Request::input('preimg');
        if(isset($preimg)){
            foreach ($preimg as $key => $pre) {
                    $BidImage['bid_id']=$BidQueue_row->id;
                    $BidImage['request_id']=$BidQueue_row->requestqueue_id;
                    $BidImage['dealer_id']=$BidQueue_row->dealer_id;
                    $BidImage['image']=$pre;
                    BidImage::create($BidImage);
            }
        }
        $updateBidQueue=BidQueue::find(Request::input('id'));
        $updateBidQueue->visable=0;
        $updateBidQueue->tp_curve_poin = 0;
        $updateBidQueue->mp_curve_poin = 0;
        $updateBidQueue->acc_curve_poin = 0;
        $updateBidQueue->save();
        $curve=self::CalculateBidCurve($BidQueueprevious->requestqueue_id);
        return redirect('dealers/request_detail/'.$id);
    }
    public function CalculateBidCurve($id=null){
            
            $BidQueuex=BidQueue::where('requestqueue_id','=',$id)->where('status','!=','2')->where('visable','=','1')->get();
            
            $AverageTp=0;
            $AverageMp=0;
            $tbid=0;
            $curveArray=array();
            foreach ($BidQueuex as $key => $value) {
                $AverageTp=$AverageTp+$value->total_amount;
                $AverageMp=$AverageMp+$value->monthly_amount;
                $tbid=$tbid+1;
            }
            if($tbid==0){
                $AverageTp=$AverageTp;
                $AverageMp=$AverageMp;
            }else{
            $AverageTp=$AverageTp/$tbid;
            $AverageMp=$AverageMp/$tbid;
            }
            foreach ($BidQueuex as $key => $bid) {
                
               // $curveArray[$key]['id']=$bid->id;
               // $curveArray[$key]['tp_curve_poin']=(($bid->total_amount-$AverageTp)/$AverageTp)*100;
               // $curveArray[$key]['mp_curve_poin']=(($bid->monthly_amount-$AverageMp)/$AverageMp)*100;
               // $curveArray[$key]['acc_curve_poin']=((((($bid->total_amount-$AverageTp)/$AverageTp)*100)*.5)+(((($bid->monthly_amount-$AverageMp)/$AverageMp)*100)*.5))/2;
                $BidQueue = BidQueue::find($bid->id);
                $BidQueue->tp_curve_poin = (($bid->total_amount-$AverageTp)/$AverageTp)*100;
                $BidQueue->mp_curve_poin = (($bid->monthly_amount-$AverageMp)/$AverageMp)*100;
                $BidQueue->acc_curve_poin = ((((($bid->total_amount-$AverageTp)/$AverageTp)*100)*.5)+(((($bid->monthly_amount-$AverageMp)/$AverageMp)*100)*.5))/2;
                $BidQueue->save();

            }
            return 1;

    }
    public function BlockAction(){
        $obj = new helpers();
        if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
       $dealer_userid=Session::get('dealer_userid');
       $Dealer = Dealer::where('id', $dealer_userid)->first();
       return view('front.dealer.blocked',compact('Dealer'),array('title'=>'DEALERSDIRECT | Dealers Add Make'));
      
    }
    public function DealerStopBid($id=null){

                $obj = new helpers();
                    if(!$obj->checkDealerLogin())
                    {
                    return redirect('dealer-signin');
                    }
                
                    $dealid=Session::get('dealer_userid');
                    $Dealerdet=Dealer::find($dealid);
                    if($Dealerdet->status==0){
                        return redirect('/dealers/blocked');
                    }else{
                        $id=base64_decode($id);
                        $RequestDealerLog=RequestDealerLog::where('id', $id)->first();
                        $dealer_userid=Session::get('dealer_userid');
                        $BidQueues=BidQueue::where("dealer_id",$dealer_userid)->where("requestqueue_id",$RequestDealerLog->request_id)->get();
                         $BidQueuesfirst=BidQueue::where("dealer_id",$dealer_userid)->where("requestqueue_id",$RequestDealerLog->request_id)->first();
                        
                            $BidStopLogDetail['dealer_id'] =$BidQueuesfirst->dealer_id;
                            $BidStopLogDetail['request_id'] =$id;
                            $BidStopLogDetail['details'] ="Bid Stop By Dealers";
                            $BidStopLogDetail_row=BidStopLogDetail::create($BidStopLogDetail);

                        foreach ($BidQueues as $key => $BidQueue) {
                                $BidStopLog['requestqueue_id']=$BidQueue->requestqueue_id;
                                $BidStopLog['dealer_id']=$BidQueue->dealer_id;
                                $BidStopLog['bid_id']=$BidQueue->bid_id;
                                $BidStopLog['total_amount']=$BidQueue->total_amount;
                                $BidStopLog['monthly_amount']=$BidQueue->monthly_amount;
                                $BidStopLog['details']=$BidQueue->details;
                                $BidStopLog['tp_curve_poin']=$BidQueue->tp_curve_poin;
                                $BidStopLog['mp_curve_poin']=$BidQueue->mp_curve_poin;
                                $BidStopLog['acc_curve_poin']=$BidQueue->acc_curve_poin;
                                $BidStopLog['stop_id']=$BidStopLogDetail_row->id;
                                $BidStopLog_row=BidStopLog::create($BidStopLog);
                                BidQueue::where('id', '=', $BidQueue->id)->delete();
                        }
                        $curve=self::CalculateBidCurve($id);
                        $xes=base64_encode($id);
                        return redirect('dealers/request_detail/'.$xes);
                    }

    }
    public function DealerAdminList(){
        $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            $dealer_userid=Session::get('dealer_userid');
            $Dealers = Dealer::where('parent_id', $dealer_userid)->with('dealer_details')->get();
            
        return view('front.dealer.dealer_admins',compact('Dealers'),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }
    public function DealerAdminAdd(){
        $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            if(Request::isMethod('post')){
                $dealer_userid=Session::get('dealer_userid');
                //print_r(Request::input());
                $tamo=time()."DEALERS";
                $hashpassword = Hash::make(Request::input('password'));
                $Dealer['first_name'] =Request::input('fname');
                $Dealer['last_name'] =Request::input('lname');
                $Dealer['email'] =Request::input('email');
                $Dealer['password'] =$hashpassword;
                $Dealer['code_number'] =$tamo;
                $Dealer['parent_id'] =$dealer_userid;
                $Dealers_row=Dealer::create($Dealer);
                $lastinsertedId = $Dealers_row->id;
                if(Request::hasFile('images')){
                    $imgval=Request::file('images');
                    $extension =$imgval->getClientOriginalExtension();
                    $destinationPath = 'public/dealers/';   // upload path
                    
                    $extension =$imgval->getClientOriginalExtension(); // getting image extension
                    $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
                    $imgval->move($destinationPath, $fileName); // uploading file to given path

                   
                }else{
                    $fileName = "";
                }
                $DealerDetail['dealer_id']=$lastinsertedId;
                $DealerDetail['zip']=Request::input('zip');
                $DealerDetail['phone']=Request::input('phone');
                $DealerDetail['address']=Request::input('address');
                $DealerDetail['image']=$fileName;
                DealerDetail::create($DealerDetail);

                $make=DealerMakeMap::where('dealer_id',$dealer_userid)->get();
                foreach ($make as $key => $value) {
                    $DealerMakeMap['dealer_id']=$lastinsertedId;
                    $DealerMakeMap['make_id']=$value->make_id;
                    DealerMakeMap::create($DealerMakeMap);
                }
                return redirect('/dealer/admins');
            }
        return view('front.dealer.dealer_admin_add',compact(''),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }
}
