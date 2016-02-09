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
use App\Model\State;                                        /* Model name*/
use App\Model\City;                                         /* Model name*/
use App\Model\ContactList;                                  /* Model name*/
use App\Model\LeadContact;                                  /* Model name*/
use App\Model\ReminderLead;                                 /* Model name*/
use App\Model\SiteContactPrice;                                 /* Model name*/
use App\Model\DealersInfo;                                 /* Model name*/
use App\Model\DealersAdminBidManagement;                                 /* Model name*/
use App\Model\DealerMembership;                                 /* Model name*/

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
use Validator;

class DealerController extends BaseController {
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
           /* $rules = array('email' => 'required|email', 'password' => 'required|min:6');
            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails())
            {
                $msg = $validator->messages();
                //dd(Request::old('email'));
                Session::flash('error',$msg );
                return redirect('dealer-signin');
            } */
            //else 
            //{
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
                            Session::flash('error1', 'Email or password does not match.'); 
                            return redirect('dealer-signin');
                        }
                   
                }
                else{
                        Session::flash('error1', 'Email or password does not match.'); 
                        return redirect('dealer-signin');
                }

            //}
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
        $State=[''=>'Select State']+State::lists('state', 'id')->all();
        $client=0;
        return view('front.dealer.dealer_signup',compact('Makes','client','State'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
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
    public function bidList(){
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
            
            return view('front.dealer.dealer_bid_list',compact('Makes','Status'),array('title'=>'DEALERSDIRECT | Dealers Signup'));
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
                
                if($RequestQueue->client_id!=0){
                
                $RequestQueue->clients->first_name=self::maskcreate($RequestQueue->clients->first_name);
                $RequestQueue->clients->last_name=self::maskcreate($RequestQueue->clients->last_name);
                $RequestQueue->clients->phone=self::maskcreate($RequestQueue->clients->phone);
                $RequestQueue->clients->email=self::maskcreate($RequestQueue->clients->email);
                $RequestQueue->clients->zip=self::maskcreate($RequestQueue->clients->zip);
                $clx=array();
                }
                else{
                $clx['first_name']=self::maskcreate($RequestQueue->fname);
                $clx['last_name']=self::maskcreate($RequestQueue->lname);
                $clx['phone']=self::maskcreate($RequestQueue->phone);
                $clx['email']=self::maskcreate($RequestQueue->email);
                $clx['zip']=self::maskcreate($RequestQueue->zip); 
                }
                //dd($RequestQueue);
                $RequestQueue->request_dealer_log=$RequestDealerLog;
                $EdmundsMakeModelYearImage=EdmundsMakeModelYearImage::where('make_id',$RequestQueue->make_id)->where('model_id',$RequestQueue->carmodel_id)->where('year_id',$RequestQueue->year)->groupBy('local_path_big')->get();
                if($par!=0){
                    $BidQueuecount=BidQueue::where('dealer_admin', $dealer_userid)->where('requestqueue_id', $RequestQueue->id)->where('visable','=','1')->count();
                }else{
                    $BidQueuecount=BidQueue::where('dealer_id', $dealer_userid)->where('requestqueue_id', $RequestQueue->id)->where('visable','=','1')->count();
                }
                
            

            return view('front.dealer.dealer_request_details',compact('RequestQueue','EdmundsMakeModelYearImage','BidQueuecount','fill','clx'),array('title'=>'DEALERSDIRECT | Dealers Request Details'));
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
                $Dealer = Dealer::where('id', $dealer_userid)->first();
                
                if($Dealer->parent_id==0){
                    $Dealerset = Dealer::where('parent_id', $dealer_userid)->get();
                    foreach ($Dealerset as $key => $eachdealer) {
                        $DealerMakeMap['dealer_id']=$eachdealer->id;
                        $DealerMakeMap['make_id']=$value;
                        DealerMakeMap::create($DealerMakeMap);
                        $RequestQueue_rowset=RequestQueue::where('make_id', '=', $value)->get();

                        if(isset($RequestQueue_rowset)){
                            foreach ($RequestQueue_rowset as $rqueueset) {
                                    $RequestDealerLogx['dealer_id']=$dealer_userid;
                                    $RequestDealerLogx['dealer_admin']=$eachdealer->id;
                                    $RequestDealerLogx['request_id']=$rqueueset->id;
                                    $RequestDealerLogx['make_id']=$rqueueset->make_id;
                                    $RequestDealerLogx['status']=1;

                                    RequestDealerLog::create($RequestDealerLogx);
                                    //dd($RequestDealerLogx);
                            }
                        }
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
            $State=[''=>'Select State']+State::lists('state', 'id')->all();
       $dealer_userid=Session::get('dealer_userid');
       $Dealer = Dealer::where('id', $dealer_userid)->with('dealer_parent','dealer_details','dealer_details.dealer_state','dealer_details.dealer_city')->first();
       $dealer_info=DealersInfo::where('dealer_id','=',$dealer_userid)->first();
     //  dd($dealer_info);
       if(isset($Dealer->dealer_details->dealer_city)){
        $cityarr=1;
        $City=[''=>'Select City']+City::where('state_id',$Dealer->dealer_details->dealer_state->id)->lists('city', 'id')->all();
       }else{
        $cityarr=0;
        $City="";
       }
       //dd($Dealer);
       return view('front.dealer.dealer_profile',compact('Dealer','State','cityarr','City','dealer_info'),array('title'=>'DEALERSDIRECT | Dealers Add Make'));
       //print_r($Dealer);

    }
    public function ProfileEditDetails(){

        //dd(Request::all());
        $fname=Request::input('fname');
        $lname=Request::input('lname');
        $zip=Request::input('zip');
        $dealer_userid=Session::get('dealer_userid');
        $dealership_name = Request::input('d_name1');
        $Dealer = Dealer::find($dealer_userid);
        $parent=Session::get('dealer_parent');
        if($parent==0){
            $Dealer->dealership_name = $dealership_name;
        }else{
            $Dealer->dealership_name ="";
        }
        
        
        $Dealer->first_name = $fname;
        $Dealer->last_name = $lname;
        $Dealer->zip = $zip;
        $Dealer->save();

                if (Request::file('new_image')) {
                    $image = Request::file('new_image');
                    $extension =$image->getClientOriginalExtension();
                    $destinationPath = 'public/dealers/';
                    $fileName = rand(111111111,999999999).'.'.$extension;
                    $image->move($destinationPath, $fileName);
                }
                else
                {
                    $fileName = Request::input('old_image');
                }

        $Dealerdetailscount = DealerDetail::where('dealer_id',$dealer_userid)->count();
        if($Dealerdetailscount==0){
                    $DealerDetail['dealer_id']=$dealer_userid;
                    $DealerDetail['zip']=Request::input('zip');
                    $DealerDetail['phone']=Request::input('phone');
                    $DealerDetail['address']=Request::input('address');
                    $DealerDetail['state_id']=Request::input('state_id');
                    $DealerDetail['city_id']=Request::input('city_id');
                    $DealerDetail['image']=$fileName;
                    DealerDetail::create($DealerDetail);
        }
        else{
            $Dealerdetails = DealerDetail::where('dealer_id',$dealer_userid)->first();

                $Dealerdetails->zip=Request::input('zip');
                $Dealerdetails->phone=Request::input('phone');
                $Dealerdetails->address=Request::input('address');
                $Dealerdetails->state_id=Request::input('state_id');
                $Dealerdetails->city_id=Request::input('city_id');
                $Dealerdetails->image=$fileName;
                $Dealerdetails->save();
        }
        
        
        
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


    

    public function ProfileMoreDetails(Request $request){
        
        $dealer_userid=Session::get('dealer_userid');

        $web_url=Request::input('web_url');
        $phone_no=Request::input('phone_no');
        $email_id=Request::input('email_id');
        $contact_address=Request::input('contact_address');
        $details=Request::input('details');
        if (Request::file('dealer_logo')){
                    $logo = Request::file('dealer_logo');
                    $extension =$logo->getClientOriginalExtension();
                    $destinationPath = 'public/dealers/';
                    $fileName = rand(111111111,999999999).'.'.$extension;
                    $logo->move($destinationPath, $fileName);
        }else{
            $fileName=Request::input('old_image');
        }
        if(Request::input('info_id')){
            $id=Request::input('info_id');
            $DealersInfo=DealersInfo::find($id);
            $DealersInfo->dealer_id=$dealer_userid;
            $DealersInfo->website_url=$web_url;
            $DealersInfo->phone_no=$phone_no;
            $DealersInfo->email_id=$email_id;
            $DealersInfo->contact_address=$contact_address;
            $DealersInfo->details=$details;
            $DealersInfo->logo=$fileName;
            $DealersInfo->update();
        }else{
        $DealersInfo = new DealersInfo;
        $DealersInfo->dealer_id=$dealer_userid;
        $DealersInfo->website_url=$web_url;
        $DealersInfo->phone_no=$phone_no;
        $DealersInfo->email_id=$email_id;
        $DealersInfo->contact_address=$contact_address;
        $DealersInfo->details=$details;
        $DealersInfo->logo=$fileName;
        $DealersInfo->save();
        }
        

        return \Redirect::back()->with('success','Information Updated');
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
        $dealer_userid=Session::get('dealer_userid');
        $id=base64_encode(Request::input('request_id'));
        $Dealers_check = Dealer::where('id', $dealer_userid)->first();
        $inox=Request::input('id');
        if($Dealers_check->parent_id==0){
            $dealer_idp=$dealer_userid;
            $dealer_ida=0;

            RequestDealerLog::where('dealer_id',$dealer_idp)->where('dealer_admin','!=',0)->where('request_id',$inox)->delete();
            RequestDealerLog::where('dealer_id',$dealer_idp)->where('dealer_admin',0)->where('request_id',$inox)->update(array('reserved' => 1,'bid_flag' => 1));
        }
        else{
            $dealer_ida=$dealer_userid;
            $dealer_idp=$Dealers_check->parent_id;
            $get_dealer_admin_bid_info=DealersAdminBidManagement::where('dealer_id',$dealer_ida)->first();
            if(!empty($get_dealer_admin_bid_info)){
                $total_amount=Request::input('total_amount');
                $monthly_amount=Request::input('monthly_amount');
                if($total_amount > $get_dealer_admin_bid_info->total_amount_per_bid){
                    return \Redirect::back()->with('error','Maximum bid amount exceed');
                }
                if($monthly_amount > $get_dealer_admin_bid_info->monthly_amount_per_bid){
                   return \Redirect::back()->with('error','Maximum bid amount exceed'); 
                }
            }
            RequestDealerLog::where('dealer_id',$dealer_idp)->whereNotIn('dealer_admin',array(0,$dealer_ida))->where('request_id',$inox)->delete();
            RequestDealerLog::where('dealer_id',$dealer_idp)->whereIn('dealer_admin',array(0,$dealer_ida))->where('request_id',$inox)->update(array('reserved' => 1,'bid_flag' => 1));
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
            $Dealers = Dealer::where('parent_id', $dealer_userid)->with('dealer_details','dealer_bid_info')->get();
            
        return view('front.dealer.dealer_admins',compact('Dealers'),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }
    public function DealerAdminAdd(){
        $obj = new helpers();
            if(!$obj->checkDealerLogin())
            {
            return redirect('dealer-signin');
            }
            $Dealer_xid= Session::get('dealer_userid');
            $dealer_admin_details = Dealer::where('id',$Dealer_xid)->first();
            if(Request::isMethod('post'))
            {
                
                    $dealer_userid=Session::get('dealer_userid');
                   
                    $tamo=time()."DEALERS";
                    $hashpassword = Hash::make(Request::input('password'));
                    $Dealer['first_name'] =Request::input('fname');
                    $Dealer['last_name'] =Request::input('lname');
                    $Dealer['email'] =Request::input('email');
                    $Dealer['password'] =$hashpassword;
                    $Dealer['code_number'] =$tamo;
                    $Dealer['parent_id'] =$dealer_userid;
                    $Dealer['zip']=Request::input('zip');
                    $Dealers_row=Dealer::create($Dealer);
                    $lastinsertedId = $Dealers_row->id;
                    if(Request::hasFile('images')){
                        $imgval=Request::file('images');
                        $extension =$imgval->getClientOriginalExtension();
                        $destinationPath = 'public/dealers/';   // upload path
                        
                        //$extension =$imgval->getClientOriginalExtension(); // getting image extension
                        $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
                        $imgval->move($destinationPath, $fileName); // uploading file to given path

                       
                    }else{
                        $fileName = "";
                    }
                    $DealerDetail['dealer_id']=$lastinsertedId;
                    $DealerDetail['zip']=Request::input('zip');
                    $DealerDetail['phone']=Request::input('phone');
                    $DealerDetail['address']=Request::input('address');
                    $DealerDetail['state_id']=Request::input('state_id');
                    $DealerDetail['city_id']=Request::input('city_id');
                    $DealerDetail['image']=$fileName;
                    DealerDetail::create($DealerDetail);
                  
                    
                    $DealersAdminBidManagement['dealer_id']=$lastinsertedId;
                    $DealersAdminBidManagement['parent_id']=$dealer_userid;
                    $DealersAdminBidManagement['total_amount_per_bid']=Request::input('total_amount');
                    $DealersAdminBidManagement['monthly_amount_per_bid']=Request::input('monthly_amount');
                    DealersAdminBidManagement::create($DealersAdminBidManagement);
                    
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
                //}
            }
        $State=[''=>'Select State']+State::lists('state', 'id')->all();
        return view('front.dealer.dealer_admin_add',compact('dealer_admin_details','State'),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }

    public function EditAdminDetails($Dealer_id)
    {
        $State=[''=>'Select State']+State::lists('state', 'id')->all();
       $dealer_userid=Session::get('dealer_userid');
       $dealer_admin_details = Dealer::where('id',$Dealer_id)->with('dealer_parent','dealer_details','dealer_details.dealer_state','dealer_details.dealer_city')->first();
       $dealer_admin_bid_info=DealersAdminBidManagement::where('dealer_id',$Dealer_id)->first();
       if(isset($dealer_admin_details->dealer_details->dealer_city)){
        $cityarr=1;
        $City=[''=>'Select City']+City::where('state_id',$dealer_admin_details->dealer_details->dealer_state->id)->lists('city', 'id')->all();
       }else{
        $cityarr=0;
        $City="";
       }
        

        return view('front.dealer.dealer_admin_edit',compact('dealer_admin_details','State','cityarr','City','dealer_admin_bid_info'),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }

    public function UpdateAdminDetails($id)
    {
          $rules = array(
            'new_fname' => 'required', 
            'new_lname' => 'required',
            'new_zip' => 'required|numeric',
            'new_phone' => 'required|numeric',
            'new_address' => 'required');

            $validator = Validator::make(Request::all(), $rules);
            if ($validator->fails())
            {
                $msg = $validator->messages();
                Session::flash('error',$msg );
                return redirect('dealer/admins');
            } 
            else 
            {
            
                if (Request::file('new_image')) {
                    $image = Request::file('new_image');
                    $extension =$image->getClientOriginalExtension();
                    $destinationPath = 'public/dealers/';
                    $fileName = rand(111111111,999999999).'.'.$extension;
                    $image->move($destinationPath, $fileName);
                }
                else
                {
                    $fileName = Request::input('old_image');
                }
                $update_details_dealers = array(
                    'first_name' => Request::input('new_fname'),
                    'last_name' => Request::input('new_lname')
                    );
                $update_details = array(
                    'zip' => Request::input('new_zip'),
                    'address' => Request::input('new_address'),
                    'phone' => Request::input('new_phone'),
                    'state_id' => Request::input('state_id'),
                    'city_id' => Request::input('city_id'),
                    'image' => $fileName
                    );
                $query_to_dealers = Dealer::find($id); //search
                if ($query_to_dealers) {
                    $query_to_dealers->update($update_details_dealers); //update  
                    $query_to_dealer_details = DealerDetail::where('dealer_id', $id)->update($update_details);
                    if ($query_to_dealer_details) {
                        Session::flash('success', 'Successfully Updated'); 
                        return redirect('dealer/admins');
                    }
                    else
                    {
                       Session::flash('error', 'Fatal error! could not update details'); 
                        return redirect('dealer/admins');
                    }
                }
                else
                {
                    Session::flash('error', 'Fatal error! could not update details'); 
                        return redirect('dealer/admins');
                }
            }
    }
    
    public function UpdateAdminBid($id){

        $update_arr=array(
            'total_amount_per_bid'=>Request::input('total_amount'),
            'monthly_amount_per_bid'=>Request::input('monthly_amount')
            );
        $update_bid_info=DealersAdminBidManagement::where('dealer_id',$id)->update($update_arr);
        
        Session::flash('success', 'Bid Information Successfully Updated'); 
        return redirect('dealer/admins');
       
    }


    public function DealerContactList(){
        $dealer_userid=Session::get('dealer_userid');
        $Dealer=Dealer::where('id',$dealer_userid)->first();
        if($Dealer->parent_id==0){
            $ContactList=ContactList::where('dealer_id',$dealer_userid)->where('payment_status','!=',1)->with('request_details','request_details.makes','request_details.models','request_details.options','bid_details','client_details')->get();
        }else{
            $ContactList=ContactList::where('admin_id',$dealer_userid)->where('payment_status','!=',1)->with('request_details','bid_details','client_details')->get();
        }
        
        foreach ($ContactList as $key => $value) {
            $countimg=EdmundsMakeModelYearImage::where('make_id',$value->request_details->make_id)->where('model_id',$value->request_details->carmodel_id)->where('year_id',$value->request_details->year)->count();
            if($countimg!=0){
                $imx=EdmundsMakeModelYearImage::where('make_id',$value->request_details->make_id)->where('model_id',$value->request_details->carmodel_id)->where('year_id',$value->request_details->year)->groupBy('local_path_smalll')->get();
             $ContactList[$key]['imx']=$imx;
            }else{
               $ContactList[$key]['imx']=""; 
            }

        }
        // foreach ($ContactList as $key => $Contact) {
        //      dd($Contact->imx->local_path_smalll);
        // }
        
        return view('front.dealer.contact_list',compact('ContactList'),array('title'=>'DEALERSDIRECT | Dealers Contacts'));
    }

    public function DealerContactDetails($id=null){
        $ContactDetail=ContactList::where('id',$id)->with('request_details','request_details.makes','request_details.models','request_details.options','request_details.trade_ins','bid_details','bid_details.bid_image','client_details')->first();
            $countimg=EdmundsMakeModelYearImage::where('make_id',$ContactDetail->request_details->make_id)->where('model_id',$ContactDetail->request_details->carmodel_id)->where('year_id',$ContactDetail->request_details->year)->count();
            if($countimg!=0){
            $imx=EdmundsMakeModelYearImage::where('make_id',$ContactDetail->request_details->make_id)->where('model_id',$ContactDetail->request_details->carmodel_id)->where('year_id',$ContactDetail->request_details->year)->groupBy('local_path_big')->get();
            $additional_price=SiteContactPrice::all();
            //dd($additional_price[0]->price);
            //die();
            $ContactDetail['imx']=$imx;
            $ContactDetail['additional_price']=$additional_price[0]->price;
            }else{
            $ContactDetail['imx']=""; 
            }
        //dd($ContactDetail);
        return view('front.dealer.contact_details',compact('ContactDetail'),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }


    public function DealerContactPay($contact_id=null){
        $contact_id=base64_decode($contact_id);
        $ContactDetail=ContactList::where('id',$contact_id)->first();
        //dd($ContactDetail);
        $ContactDetail->payment_status=1;
        $ContactDetail->status=1;
        $ContactDetail->save();
        
        $LeadContact = new LeadContact;
        $LeadContact->request_id=$ContactDetail->request_id;
        $LeadContact->bid_id=$ContactDetail->bid_id;
        $LeadContact->dealer_id=$ContactDetail->dealer_id;
        $LeadContact->admin_id=$ContactDetail->admin_id;
        $LeadContact->client_id=$ContactDetail->client_id;
        $LeadContact->contact_id=$ContactDetail->id;
        $LeadContact->payment_status=1;
        $LeadContact->lead_status=1;
        $LeadContact->save(); 
        return redirect('dealers/lead_list');
    }
    //Dealers Membership 

    public function DealerMembership(){
        $dealer_userid=Session::get('dealer_userid');
        $get_dealer_membership_info=DealerMembership::where('dealer_id',$dealer_userid)->where('is_active',1)->first();
        
        return view('front.dealer.membership',array('title'=>'DEALERSDIRECT | Dealers Membership'),compact('get_dealer_membership_info'));
    }

    public function DealerMembershipPost(){
        $dealer_userid=Session::get('dealer_userid');
        $get_dealer_membership_info=DealerMembership::where('dealer_id',$dealer_userid)->first();
        if($get_dealer_membership_info){
            $id=$get_dealer_membership_info->id;
            $membership=DealerMembership::find($id);
            $membership->dealer_id=$dealer_userid;
            $membership->membership_type=Request::input('member_type');
            $membership->update();
            $get_dealer_membertype=DealerMembership::where('dealer_id',$dealer_userid)->first();
            $member_type=$get_dealer_membertype->membership_type;
            return \Redirect::back()->with('massage','You are now upgraded to Level '.$member_type.' Membership');
        }
        if(Request::input('member_type')==1){
            $membership=new DealerMembership;
            $membership->dealer_id=$dealer_userid;
            $membership->membership_type=1;
            $membership->save();
            return \Redirect::back()->with('massage','You are now upgraded to Level 1 Membership');
        }
        if(Request::input('member_type')==2){
            $membership=new DealerMembership;
            $membership->dealer_id=$dealer_userid;
            $membership->membership_type=2;
            $membership->save();
            return \Redirect::back()->with('massage','You are now upgraded to Level 2 Membership');
        }
        if(Request::input('member_type')==3){
            $membership=new DealerMembership;
            $membership->dealer_id=$dealer_userid;
            $membership->membership_type=3;
            $membership->save();
            return \Redirect::back()->with('massage','You are now upgraded to Level 3 Membership');
        }
        
    }

    public function DealerLeadList(){
        $dealer_userid=Session::get('dealer_userid');
        $Dealer=Dealer::where('id',$dealer_userid)->first();
        if($Dealer->parent_id==0){
            $LeadContact=LeadContact::where('dealer_id',$dealer_userid)->where('payment_status','=',1)->where('lead_status','=',1)->with('request_details','request_details.makes','request_details.models','request_details.options','bid_details','client_details')->get();
        }else{
            $LeadContact=LeadContact::where('admin_id',$dealer_userid)->where('payment_status','=',1)->where('lead_status','=',1)->with('request_details','bid_details','client_details')->get();
        }
        foreach ($LeadContact as $key => $value) {
            $countimg=EdmundsMakeModelYearImage::where('make_id',$value->request_details->make_id)->where('model_id',$value->request_details->carmodel_id)->where('year_id',$value->request_details->year)->count();
            if($countimg!=0){
                $imx=EdmundsMakeModelYearImage::where('make_id',$value->request_details->make_id)->where('model_id',$value->request_details->carmodel_id)->where('year_id',$value->request_details->year)->groupBy('local_path_big')->get();
             $LeadContact[$key]['imx']=$imx;
            }else{
               $LeadContact[$key]['imx']=""; 
            }

        }
        
        return view('front.dealer.lead_list',compact('LeadContact'),array('title'=>'DEALERSDIRECT | Dealers Leads'));
    }
    public function DealerReminderList(){
        $dealer_userid=Session::get('dealer_userid');
        $Dealer=Dealer::where('id',$dealer_userid)->first();
        if($Dealer->parent_id==0){
            $ReminderLead=ReminderLead::where('dealer_id', $dealer_userid)->with('lead_details.request_details','lead_details.request_details.makes','lead_details.request_details.models','lead_details.request_details.options','contact_details')->where('status','!=' ,1)->get();
            $ReminderLeadcount=ReminderLead::where('dealer_id', $dealer_userid)->where('status','!=' ,1)->count();
        }
        else{
            $ReminderLead=ReminderLead::where('dealer_id', $Dealer->parent_id)->with('lead_details.request_details','lead_details.request_details.makes','lead_details.request_details.models','lead_details.request_details.options','contact_details')->where('status','!=' ,1)->get();
            $ReminderLeadcount=ReminderLead::where('dealer_id', $Dealer->parent_id)->where('status','!=' ,1)->count();
        }
        return view('front.dealer.reminder_list',compact('ReminderLead'),array('title'=>'DEALERSDIRECT | Dealers Reminder List'));
    }
    public function DealerReminderDetails($reminder_id=null){
         $reminder_id=base64_decode($reminder_id);
         $Reminder=ReminderLead::where('id',$reminder_id)->with('lead_details.request_details','lead_details.request_details.makes','lead_details.request_details.models','lead_details.request_details.options','contact_details')->first();
         $ContactDetail=ContactList::where('id',$Reminder->contact_id)->with('request_details','request_details.makes','request_details.models','request_details.options','request_details.trade_ins','bid_details','bid_details.bid_image','client_details')->first();
         $Reminder->status=1;
         $Reminder->save(); 
            $countimg=EdmundsMakeModelYearImage::where('make_id',$ContactDetail->request_details->make_id)->where('model_id',$ContactDetail->request_details->carmodel_id)->where('year_id',$ContactDetail->request_details->year)->count();
            if($countimg!=0){
            $imx=EdmundsMakeModelYearImage::where('make_id',$ContactDetail->request_details->make_id)->where('model_id',$ContactDetail->request_details->carmodel_id)->where('year_id',$ContactDetail->request_details->year)->groupBy('local_path_big')->get();
            $ContactDetail['imx']=$imx;
            }else{
            $ContactDetail['imx']=""; 
            }
            return view('front.dealer.reminder_details',compact('Reminder','ContactDetail'),array('title'=>'DEALERSDIRECT | Dealers Admins'));
    }
    public function DealerAnalytics(){
        $dealer_userid=Session::get('dealer_userid');
        $Dealers_check = Dealer::where('id', $dealer_userid)->first();
        if($Dealers_check->parent_id==0){

        $RequestDealerLog=RequestDealerLog::where('dealer_id', $dealer_userid)->where('dealer_admin', 0)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();

        $RequestDealerLogids=RequestDealerLog::where('dealer_id', $dealer_userid)->where('dealer_admin', 0)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
        $ContactListid=ContactList::where('dealer_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
        $ContactList=ContactList::where('dealer_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        $LeadContactid=LeadContact::where('dealer_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
        $LeadContact=LeadContact::where('dealer_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
        $BidQueue=BidQueue::where('dealer_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->groupBy('requestqueue_id')->get();
        $BidQueuecount=count($BidQueue);
        }
        else{
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $Dealers_check->parent_id)->where('dealer_admin', $dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
            $RequestDealerLogids=RequestDealerLog::where('dealer_id', $Dealers_check->parent_id)->where('dealer_admin', $dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
            $ContactListid=ContactList::where('admin_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();
            $ContactList=ContactList::where('admin_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
            $LeadContactid=LeadContact::where('admin_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->get();

            $LeadContact=LeadContact::where('admin_id',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->count();
            $BidQueue=BidQueue::where('dealer_admin',$dealer_userid)->whereMonth('created_at', '=', date('m'))->whereYear('created_at', '=', date('Y'))->groupBy('requestqueue_id')->get();
            $BidQueuecount=count($BidQueue);
        }
        
        $rq=array();
        $bq=array();
        $cq=array();
        $ld=array();
        foreach ($RequestDealerLogids as $key => $value) {
            $rq[]=$value->request_id;
        }
        $RequestQueue=RequestQueue::whereIn('id',$rq)->with('makes','models')->groupBy('make_id','carmodel_id','condition','year')->get();
        //dd($rq);
        $requ="";
        $bidu="";
        $conu="";
        $ledu="";
        foreach ($RequestQueue as $key => $Request) {
            $RequestQueuecount=RequestQueue::whereIn('id',$rq)->where('make_id',$Request->make_id)->where('carmodel_id',$Request->carmodel_id)->where('condition',$Request->condition)->where('year',$Request->year)->count();
            if($requ==""){
                $requ="['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecount."]";
            }else{
                $requ=$requ.",['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecount."]";
            }
        }
        foreach ($BidQueue as $key => $value) {
            $bq[]=$value->requestqueue_id;
        }

        $RequestQueuebq=RequestQueue::whereIn('id',$bq)->with('makes','models')->groupBy('make_id','carmodel_id','condition','year')->get();
        foreach ($RequestQueuebq as $key => $Request) {
            $RequestQueuecountbq=RequestQueue::whereIn('id',$bq)->where('make_id',$Request->make_id)->where('carmodel_id',$Request->carmodel_id)->where('condition',$Request->condition)->where('year',$Request->year)->count();
            if($bidu==""){
                $bidu="['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecountbq."]";
            }else{
                $bidu=$bidu.",['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecountbq."]";
            }
        }
        foreach ($ContactListid as $key => $value) {
            $cq[]=$value->request_id;
        }

        $RequestQueuecq=RequestQueue::whereIn('id',$cq)->with('makes','models')->groupBy('make_id','carmodel_id','condition','year')->get();
        foreach ($RequestQueuecq as $key => $Request) {
            $RequestQueuecountcq=RequestQueue::whereIn('id',$cq)->where('make_id',$Request->make_id)->where('carmodel_id',$Request->carmodel_id)->where('condition',$Request->condition)->where('year',$Request->year)->count();
            if($conu==""){
                $conu="['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecountcq."]";
            }else{
                $conu=$conu.",['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecountcq."]";
            }
        }
        
        foreach ($LeadContactid as $key => $value) {
            $ld[]=$value->request_id;
        }

        $RequestQueueld=RequestQueue::whereIn('id',$ld)->with('makes','models')->groupBy('make_id','carmodel_id','condition','year')->get();
        foreach ($RequestQueueld as $key => $Request) {
            $RequestQueuecountld=RequestQueue::whereIn('id',$ld)->where('make_id',$Request->make_id)->where('carmodel_id',$Request->carmodel_id)->where('condition',$Request->condition)->where('year',$Request->year)->count();
            if($ledu==""){
                $ledu="['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecountld."]";
            }else{
                $ledu=$ledu.",['".$Request->makes->name." ".$Request->models->name." ".$Request->year." ".$Request->condition."',".$RequestQueuecountld."]";
            }
        }
        
        $request_queues[0]['name']="REQUESTs";
        $request_queues[0]['y']=$RequestDealerLog;
        $request_queues[0]['drilldown']="REQUESTs";
        $request_queues[1]['name']="BIDs";
        $request_queues[1]['y']=$BidQueuecount;
        $request_queues[1]['drilldown']="BIDs";
        $request_queues[2]['name']="CONTACTs";
        $request_queues[2]['y']=$ContactList;
        $request_queues[2]['drilldown']="CONTACTs";
        $request_queues[3]['name']="LEADs";
        $request_queues[3]['y']=$LeadContact;
        $request_queues[3]['drilldown']="LEADs";
        $request_queues=json_encode($request_queues);
        
        //dd($request_queues);
        return view('front.dealer.analytics',compact('request_queues','requ','bidu','conu','ledu'),array('title'=>'DEALERSDIRECT | Dealers Analytics'));
    }
    public function DealerAnalyticsone(){

        
        return view('front.dealer.analyticsone',compact('request_queues'),array('title'=>'DEALERSDIRECT | Dealers Analytics'));
    }
}
