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
        $client=0;
        return view('front.dealer.dealer_signin',compact('client'),array('title'=>'DEALERSDIRECT | Dealers Signin'));
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
        $client=0;
        return view('front.dealer.dealer_signup',compact('Makes','client'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
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
            $id=Session::get('dealer_userid');
            $DealerMake=DealerMakeMap::where('dealer_id', $id)->with('makes')->orderBy('make_id', 'asc')->get();
            $Makes=array();
            $Makes['0']="All MAKES";
            foreach($DealerMake as $DealerM){
                $Makes[$DealerM->makes->id]=$DealerM->makes->name;
            }
            $Status=array();
            $Status['0']="All STATUS";
            $Status['1']="Active";
            $Status['2']="Rejected";
            $Status['3']="Blocked";
            $Status['4']="Accepted";
            //dd($Makes);
            
            return view('front.dealer.dealer_request_list',compact('Makes','Status'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
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
            if(Session::get('filter_sec_deal')){
                $fill=Session::get('filter_sec_deal');
            }
            else{
                $fill=1;
            }
            $dealer_userid=Session::get('dealer_userid');
            $par=Session::get('dealer_parent');
            $RequestDealerLog=RequestDealerLog::where('id', $id)->first();
            $requestqueue_id=$RequestDealerLog->request_id;
            $RequestQueue=RequestQueue::where('id', $requestqueue_id)->with('makes','models','clients','bids','options','options.styles','options.engines','options.transmission','options.excolor','options.incolor','options.edmundsimage','trade_ins','trade_ins.makes','trade_ins.models')->first();
            
                $RequestQueue->clients->first_name=self::maskcreate($RequestQueue->clients->first_name);
                $RequestQueue->clients->last_name=self::maskcreate($RequestQueue->clients->last_name);
                $RequestQueue->clients->phone=self::maskcreate($RequestQueue->clients->phone);
                $RequestQueue->clients->email=self::maskcreate($RequestQueue->clients->email);
                $RequestQueue->clients->zip=self::maskcreate($RequestQueue->clients->zip);
                $RequestQueue->request_dealer_log=$RequestDealerLog;
                $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RequestQueue->make_id)->where('model_id',$RequestQueue->carmodel_id)->where('year_id',$RequestQueue->year)->get();
                if($par!=0){
                    $BidQueuecount=BidQueue::where('dealer_admin', $dealer_userid)->where('requestqueue_id', $RequestQueue->id)->where('visable','=','1')->count();
                }else{
                    $BidQueuecount=BidQueue::where('dealer_id', $dealer_userid)->where('requestqueue_id', $RequestQueue->id)->where('visable','=','1')->count();
                }
                
            //dd($RequestQueue);

            return view('front.dealer.dealer_request_details',compact('RequestQueue','EdmundsMakeModelYearImage','BidQueuecount','fill'),array('title'=>'DEALERSDIRECT | Dealers Request Details'));
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
        
        $Make=Make::whereNotIn('id', $DealerMakeMap)->get();
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
        $zip=Request::input('zip');
        $Dealer = Dealer::find($dealer_userid);
        $Dealer->first_name = $fname;
        $Dealer->last_name = $lname;
        $Dealer->zip = $zip;
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
                        $RequestDealerLog=RequestDealerLog::where('id', $id)->first();
                        $requestqueue_id=$RequestDealerLog->request_id;
                        $RequestQueue=RequestQueue::where('id', $requestqueue_id)->with('makes','models','clients','bids','options','options.styles','options.engines','options.transmission','options.excolor','options.incolor','options.edmundsimage','trade_ins','trade_ins.makes','trade_ins.models')->first();
                        $RequestQueue->clients->first_name=self::maskcreate($RequestQueue->clients->first_name);
                        $RequestQueue->clients->last_name=self::maskcreate($RequestQueue->clients->last_name);
                        $RequestQueue->clients->phone=self::maskcreate($RequestQueue->clients->phone);
                        $RequestQueue->clients->email=self::maskcreate($RequestQueue->clients->email);
                        $RequestQueue->clients->zip=self::maskcreate($RequestQueue->clients->zip);
                        $RequestQueue->request_dealer_log=$RequestDealerLog;
                        return view('front.dealer.post_bid',compact('RequestQueue'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
            }
    }
    public function editBid($id=null){
            $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            
                $dealid=Session::get('dealer_userid');
                $par=Session::get('dealer_parent');
                $Dealerdet=Dealer::find($dealid);
                if($Dealerdet->status==0){
                    return redirect('/dealers/blocked');
                }else{
        
                        $id=base64_decode($id);
                        $RequestDealerLog=RequestDealerLog::where('id', $id)->first();
                        $requestqueue_id=$RequestDealerLog->request_id;
                        $RequestQueue=RequestQueue::where('id', $requestqueue_id)->with('makes','models','clients','bids','options','options.styles','options.engines','options.transmission','options.excolor','options.incolor','options.edmundsimage','trade_ins','trade_ins.makes','trade_ins.models')->first();
                        $RequestQueue->clients->first_name=self::maskcreate($RequestQueue->clients->first_name);
                        $RequestQueue->clients->last_name=self::maskcreate($RequestQueue->clients->last_name);
                        $RequestQueue->clients->phone=self::maskcreate($RequestQueue->clients->phone);
                        $RequestQueue->clients->email=self::maskcreate($RequestQueue->clients->email);
                        $RequestQueue->clients->zip=self::maskcreate($RequestQueue->clients->zip);
                        $RequestQueue->request_dealer_log=$RequestDealerLog;
                        if($par!=0){
                        $BidQueue=BidQueue::where("dealer_admin",$dealid)->where("requestqueue_id",$RequestDealerLog->request_id)->with('dealers','bid_image')->where('visable','=','1')->first();
                        }else{
                            $BidQueue=BidQueue::where("dealer_id",$dealid)->where("requestqueue_id",$RequestDealerLog->request_id)->with('dealers','bid_image')->where('visable','=','1')->first();
                        }
                        return view('front.dealer.edit_bid',compact('RequestQueue','BidQueue'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
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
        $Dealers_check = Dealer::where('id', $dealer_userid)->first();
            $inox=Request::input('id');
        if($Dealers_check->parent_id==0){
            $dealer_idp=$dealer_userid;
            $dealer_ida=0;

            RequestDealerLog::where('dealer_id',$dealer_idp)->where('dealer_admin','!=',0)->where('request_id',$inox)->delete();
            RequestDealerLog::where('dealer_id',$dealer_idp)->where('dealer_admin',0)->where('request_id',$inox)->update(array('reserved' => 1));
        }
        else{
            $dealer_ida=$dealer_userid;
            $dealer_idp=$Dealers_check->parent_id;
            RequestDealerLog::where('dealer_id',$dealer_idp)->whereNotIn('dealer_admin',array(0,$dealer_ida))->where('request_id',$inox)->delete();
            RequestDealerLog::where('dealer_id',$dealer_idp)->whereIn('dealer_admin',array(0,$dealer_ida))->where('request_id',$inox)->update(array('reserved' => 1));
        }


        $BidQueue['requestqueue_id']=Request::input('id');
        $BidQueue['dealer_id']=$dealer_idp;
        $BidQueue['dealer_admin']=$dealer_ida;
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
                    if($imgval){
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
        $BidQueue['dealer_admin']=$BidQueueprevious->dealer_admin;
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
        $RequestDealerLogx=RequestDealerLog::where('dealer_id', $BidQueueprevious->dealer_id)->where('request_id', $BidQueueprevious->requestqueue_id)->first();

        $RequestDealerLogx_id=base64_encode($RequestDealerLogx->id);
        return redirect('dealers/request_detail/'.$RequestDealerLogx_id);
    }
    public function CalculateBidCurve($id=null){
            
            $BidQueuex=BidQueue::where('requestqueue_id','=',$id)->where('status','=','0')->where('visable','=','1')->get();
            
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
                $makex=DealerMakeMap::where('dealer_id',$lastinsertedId)->get();
                
                foreach ($makex as $key => $mid) {
                    $dmid=$mid->make_id;
                    $RequestDealerLogcount=RequestDealerLog::where('make_id', $dmid)->where('dealer_id', $dealer_userid)->where('reserved','!=',1)->count();
                   
                    if($RequestDealerLogcount!=0){
                        $RequestDealerLogget=RequestDealerLog::where('make_id', $dmid)->where('dealer_id', $dealer_userid)->where('dealer_admin',0)->where('reserved','!=',1)->first();
                        $RequestDealerLog['dealer_id']=$RequestDealerLogget->dealer_id;
                        $RequestDealerLog['dealer_admin']=$lastinsertedId;
                        $RequestDealerLog['request_id']=$RequestDealerLogget->request_id;
                        $RequestDealerLog['status']=$RequestDealerLogget->status;
                        $RequestDealerLog['blocked']=$RequestDealerLogget->blocked;
                        $RequestDealerLog['reserved']=$RequestDealerLogget->reserved;
                        $RequestDealerLog['make_id']=$RequestDealerLogget->make_id;
                        RequestDealerLog::create($RequestDealerLog);
                    }


                }
                return redirect('/dealer/admins');
            }
        return view('front.dealer.dealer_admin_add',compact(''),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }
}
