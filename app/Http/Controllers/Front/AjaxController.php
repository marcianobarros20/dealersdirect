<?php

namespace App\Http\Controllers\Front;

use App\Model\Make;                                         /* Model name*/
use App\Model\Carmodel;                                     /* Model name*/
use App\Model\Caryear;                                      /* Model name*/
use App\Model\RequestQueue;		                            /* Model name*/
use App\Model\DealerMakeMap;                                /* Model name*/
use App\Model\RequestDealerLog;                             /* Model name*/
use App\Model\RequestStyleEngineTransmissionColor;          /* Model name*/
use App\Model\BidQueue;                                     /* Model name*/
use App\Model\BidAcceptanceQueue;                           /* Model name*/
use App\Model\BlockBidLog;                                  /* Model name*/
use App\Model\Client;                                       /* Model name*/
use App\Model\Dealer;                                       /* Model name*/
use App\Model\EdmundsMakeModelYearImage;                    /* Model name*/
use App\Model\EdmundsStyleImage;                            /* Model name*/
use App\Model\TradeinRequest;                               /* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Input;
use Mail;
use Illuminate\Support\Facades\Request;
use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use App\Helper\helpers;

class AjaxController extends Controller
{
    //
    public function getmodel()
    {
        $make_search=Request::input('make_search');
        //print_r($make_search);
        $Carmodel=Carmodel::where("make_id",$make_search)->get();
        //print_r($Carmodel);

        return view('front.ajax.create_model_types',compact('Carmodel'));
    }
    public function getyear()
    {
        $make_search=Request::input('make_search');
        $model_search=Request::input('model_search');
        // print_r($make_search);
        // print_r($model_search);
        if($model_search==0){
        	$Caryear=Caryear::where("make_id",$make_search)->groupBy('year')->get();
        }
        else{
        	$Caryear=Caryear::where("make_id",$make_search)->where("carmodel_id",$model_search)->groupBy('year')->get();
        }
        return view('front.ajax.create_year_types',compact('Caryear'));
    }
    public function requirmentqueue()
    {
        //dd(Request::input());
        $make_search=Request::input('make_search');
        $model_search=Request::input('model_search');
        $condition_search=Request::input('condition_search');
        $year_search=Request::input('year_search');
        $tamo=Request::input('tamo');
        $mtamo=Request::input('mtamo');
        $fname=Request::input('fname');
        $lname=Request::input('lname');
        $phone=Request::input('phone');
        $email=Request::input('email');

        $tradein=Request::input('tradein');
        $trademake_search=Request::input('trademake_search');
        $trademodel_search=Request::input('trademodel_search');
        $tradecondition_search=Request::input('tradecondition_search');
        $tradeyear_search=Request::input('tradeyear_search');
        
        
        $RequestQueue['make_id'] =$make_search;
        $RequestQueue['carmodel_id'] =$model_search;
        $RequestQueue['condition'] =$condition_search;
        $RequestQueue['year'] =$year_search;
        $RequestQueue['total_amount'] =$tamo;
        $RequestQueue['monthly_amount'] =$mtamo;
        $RequestQueue['fname'] =$fname;
        $RequestQueue['lname'] =$lname;
        $RequestQueue['phone'] =$phone;
        $RequestQueue['email'] =$email;
        $RequestQueue['im_type'] =0;
        if($tradein=="yes"){
        $RequestQueue['trade_in']=1;
        $TradeinRequest['make_id'] =$trademake_search;
        $TradeinRequest['carmodel_id'] =$trademodel_search;
        $TradeinRequest['condition'] =$tradecondition_search;
        $TradeinRequest['year'] =$tradeyear_search;
        $owe=Request::input('owe');
            if(isset($owe)){
                $TradeinRequest['owe'] =Request::input('owe');
                $TradeinRequest['owe_amount'] =Request::input('oweamount');

            }
        
        $TradeinRequest['fname'] =$fname;
        $TradeinRequest['lname'] =$lname;
        $TradeinRequest['phone'] =$phone;
        $TradeinRequest['email'] =$email;
        $TradeinRequest['im_type'] =0;
        }
        self::ApiGetImageNotStyle($make_search,$model_search,$year_search);
        $RequestQueue['im_type'] =1;
        
        $RequestQueue_row=RequestQueue::create($RequestQueue);
        $lastinsertedId = $RequestQueue_row->id;
        
        if(isset($TradeinRequest)){
            self::ApiGetImageNotStyle($trademake_search,$trademodel_search,$tradeyear_search);
            $TradeinRequest['im_type'] =1;
            
            $TradeinRequest['request_queue_id'] =$lastinsertedId;
            $TradeinRequest=TradeinRequest::create($TradeinRequest);
           
        }
        $DealerMakeMap = DealerMakeMap::where('make_id', $make_search)->get();
          foreach ($DealerMakeMap as $value) {
              $RequestDealerLog['dealer_id']=$value->dealer_id;
              $RequestDealerLog['request_id']=$lastinsertedId;
              $RequestDealerLog['make_id']=$make_search;
              $RequestDealerLog['status']=1;
              $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
              $lastlog = $RequestDealerLog_row->id;
              self::SendRemindermail($lastlog);
              
          }
        
        Session::forget('guest_user');
        
        echo base64_encode($lastinsertedId);
        exit;
        
        
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
    public function deletedealermake(){
      $makeid=Request::input('makeid');
      $dealer_userid=Session::get('dealer_userid');
      DealerMakeMap::where('dealer_id', '=', $dealer_userid)->where('make_id', '=', $makeid)->delete();
      RequestDealerLog::where('dealer_id', '=', $dealer_userid)->where('make_id', '=', $makeid)->delete();
      echo "Deleted";
    }
    public function AddStyleToRequestqueue(){
        //print_r(Request::input());
        $requestid=Request::input('requestid');
        $count_by_request=RequestStyleEngineTransmissionColor::where("requestqueue_id",$requestid)->count();
        $RequestStyleEngineTransmissionColor['requestqueue_id']=Request::input('requestid');
        $RequestStyleEngineTransmissionColor['style_id']=Request::input('styleid');
        $RequestStyleEngineTransmissionColor['count']=$count_by_request+1;
        $RequestStyleEngineTransmissionColor_row=RequestStyleEngineTransmissionColor::create($RequestStyleEngineTransmissionColor);
        $styleid=Request::input('styleid');
        $requestqueueid=Request::input('requestid');
        $EdmundsStyleImage_count=EdmundsStyleImage::where('style_id',$styleid)->count();
        $RequestQueue=RequestQueue::where('id', $requestqueueid)->first();
        if($EdmundsStyleImage_count==0){
                    
                    // $url = "https://api.edmunds.com/v1/api/vehiclephoto/service/findphotosbystyleid?styleId=".$styleid."&fmt=json&api_key=meth499r2aepx8h7c7hcm9qz";
                    $url = "https://api.edmunds.com/api/media/v2/styles/".$styleid."/photos?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz";
                    $ch = curl_init();
                    curl_setopt($ch,CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    $result = curl_exec($ch);
                    curl_close($ch);
                    $resuls=json_decode($result, true);
        
                    foreach ($resuls['photos'] as $photoskey => $photos) {
                            $makephoto['make_id']=$RequestQueue->make_id;
                            $makephoto['model_id']=$RequestQueue->carmodel_id;
                            $makephoto['year_id']=$RequestQueue->year;
                            $makephoto['title']=$photos['title'];
                            $makephoto['style_id']=$styleid;
                            $makephoto['category']=$photos['category'];
                                foreach ($photos['sources'] as $sources) {
                                    if($sources['size']['width']=="500"){
                                            $makephoto['edmunds_path_big']=$sources['link']['href'];
                                        }
                                    if($sources['size']['width']=="1280"){
                                        $makephoto['edmunds_path_big']=$sources['link']['href'];
                                    }
                                    if($sources['size']['width']=="1600"){
                                        $makephoto['edmunds_path_big']=$sources['link']['href'];
                                    }
                                    if($sources['size']['width']=="196"){
                                        $makephoto['edmunds_path_small']=$sources['link']['href'];
                                    }
                                    if($sources['size']['width']=="276"){
                                        $makephoto['edmunds_path_small']=$sources['link']['href'];
                                    }
                                }
                                $bcontent = file_get_contents("https://media.ed.edmunds-media.com".$makephoto['edmunds_path_big']);
                                $bnpath=time().".jpg";
                                $bigpathe="public/edmundsstyle/style/big/".$bnpath;
                                $fbp = fopen($bigpathe, "w");
                                fwrite($fbp, $bcontent);
                                fclose($fbp);

                                $scontent = file_get_contents("https://media.ed.edmunds-media.com".$makephoto['edmunds_path_small']);
                                $smpath=time().".jpg";
                                $smallpathe="public/edmundsstyle/style/small/".$smpath;
                                $fsp = fopen($smallpathe, "w");
                                fwrite($fsp, $scontent);
                                fclose($fsp);
                                $makephoto['local_path_big']=$bnpath;
                                $makephoto['local_path_smalll']=$smpath;
                                EdmundsStyleImage::create($makephoto);
                    }

        }
        
            
            $RequestQueue->im_type = 2;
            $RequestQueue->save();
         return $lastinsertedId = $RequestStyleEngineTransmissionColor_row->id;
        exit;
    }
    public function AddEngineToRequestqueue(){
        
        $requestid=Request::input('requestid');
        $engineid=Request::input('engineid');
        $count=Request::input('count');
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$requestid)->where('count',$count)->first();
        $RequestStyleEngineTransmissionColor->engine_id = $engineid;
        $RequestStyleEngineTransmissionColor->save();
        return $RequestStyleEngineTransmissionColor->id;
    }
    public function AddTransmissionToRequestqueue(){
        $requestid=Request::input('requestid');
        $transmissionid=Request::input('transmissionid');
        $count=Request::input('count');
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$requestid)->where('count',$count)->first();
        $RequestStyleEngineTransmissionColor->transmission_id = $transmissionid;
        $RequestStyleEngineTransmissionColor->save();
        return $RequestStyleEngineTransmissionColor->id;

    }
    public function AddExteriorColorToRequestqueue(){
        $requestid=Request::input('requestid');
        $colorid=Request::input('colorid');
        $count=Request::input('count');
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$requestid)->where('count',$count)->first();
        $RequestStyleEngineTransmissionColor->exterior_color_id = $colorid;
        $RequestStyleEngineTransmissionColor->save();
        return $RequestStyleEngineTransmissionColor->id;

    }
    public function AddInteriorColorToRequestqueue(){
        $requestid=Request::input('requestid');
        $colorid=Request::input('colorid');
        $count=Request::input('count');
        $RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::where("requestqueue_id",$requestid)->where('count',$count)->first();
        $RequestStyleEngineTransmissionColor->interior_color_id = $colorid;
        $RequestStyleEngineTransmissionColor->save();
        return $RequestStyleEngineTransmissionColor->requestqueue_id;

    }
    public function RejectDealerBid(){
        
        $BidQueue=BidQueue::find(Request::input('requestid'));
        $BidQueue->status = 2;
        $BidQueue->details_of_actions = Request::input('rejectdetails');
        $BidQueue->save();
        $id=$BidQueue->requestqueue_id;

        $BidQueuex=BidQueue::where('requestqueue_id','=',$id)->where('status','!=','2')->get();
            
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
                
               
                $BidQueuenew = BidQueue::find($bid->id);
                $BidQueuenew->tp_curve_poin = (($bid->total_amount-$AverageTp)/$AverageTp)*100;
                $BidQueuenew->mp_curve_poin = (($bid->monthly_amount-$AverageMp)/$AverageMp)*100;
                $BidQueuenew->acc_curve_poin = ((((($bid->total_amount-$AverageTp)/$AverageTp)*100)*.5)+(((($bid->monthly_amount-$AverageMp)/$AverageMp)*100)*.5))/2;
                $BidQueuenew->save();

            }
            $bid=Request::input('requestid');
            $details_of_actions=Request::input('rejectdetails');
            self::SendRejectemail($bid,$details_of_actions);
            return 1;


    }
    public function SendRejectemail($id=null,$details=null){
            
            $BidQueue_row=BidQueue::where('id',$id)->with('dealers','request_queues')->first();
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $BidQueue_row->dealer_id)->where('request_id', $BidQueue_row->requestqueue_id)->first();
            $RequestQueue_row=RequestQueue::where('id',$BidQueue_row->requestqueue_id)->with('clients','makes','models')->first();
            
            $BidQueuecount=BidQueue::where('requestqueue_id' ,$BidQueue_row->requestqueue_id)->where('visable','=','1')->count();
            $dealer_email=$BidQueue_row->dealers->email;
            $dealer_name=$BidQueue_row->dealers->first_name." ".$BidQueue_row->dealers->last_name;
            $admin_users_email="hello@tier5.us";
            $project_make=$RequestQueue_row->makes->name;
            $project_model=$RequestQueue_row->models->name;
            $project_year=$RequestQueue_row->year;
            $project_conditions=$RequestQueue_row->condition;
            $project_bidcount=$BidQueuecount;
            $client_email=$RequestQueue_row->clients->email;
            $client_name=$RequestQueue_row->clients->first_name." ".$RequestQueue_row->clients->last_name;
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($RequestDealerLog->id);
            $activateLinkclient = url('/').'/client/request_detail/'.$BidQueue_row->requestqueue_id;
            $admin_users_email="hello@tier5.us";
            $sent = Mail::send('front.email.rejectbidLink', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLink, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount,'client_name'=>$client_name,'details'=>$details), 
            function($message) use ($admin_users_email, $dealer_email,$dealer_name)
            {
            $message->from($admin_users_email);
            $message->to($dealer_email, $dealer_name)->subject('Bid Request Rejected By Client');
            });
            $senttoclient = Mail::send('front.email.rejectbidLinkclient', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLinkclient, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount,'dealer_name'=>$dealer_name,'details'=>$details), 
            function($message) use ($admin_users_email, $client_email,$client_name)
            {
            $message->from($admin_users_email);
            $message->to($client_email, $client_name)->subject('Bid Request Rejected');
            });

            return 1;
    }
    public function GetUpdatedBid(){
        
        $id=base64_decode(Request::input('requestid'));
        $sortby=Request::input('sortby');
        $pageend=Request::input('pageend');
        $pagestart=Request::input('pagestart');
        $RequestDealerLog_row=RequestDealerLog::where('request_id',$id)->where('blocked','!=',1)->lists('dealer_id');

        if($sortby==1){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->where('visable','=','1')->with('dealers','bid_image')->orderBy('acc_curve_poin', 'asc')->get();
        }
        if($sortby==2){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->where('visable','=','1')->with('dealers','bid_image')->orderBy('mp_curve_poin', 'asc')->get();
        }
        if($sortby==3){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->where('visable','=','1')->with('dealers','bid_image')->orderBy('tp_curve_poin', 'asc')->get();
        }
        
        $RequestQueue_row=RequestQueue::where('id',$id)->first();
        return view('front.ajax.get_update_bid',compact('BidQueue','RequestQueue_row'),array('title'=>'DEALERSDIRECT | Client Request Details'));
    }
    public function GetUpdatedBidDealer(){
        
        $id=base64_decode(Request::input('requestid'));
        $sortby=Request::input('sortby');
        $pageend=Request::input('pageend');
        $pagestart=Request::input('pagestart');
        $RequestDealerLog_row=RequestDealerLog::where('request_id',$id)->where('blocked','!=',1)->lists('dealer_id');
         if($sortby==1){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->with('dealers','bid_image')->orderBy('acc_curve_poin', 'asc')->groupBy('dealer_id')->get();
        }
        if($sortby==2){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->with('dealers','bid_image')->orderBy('mp_curve_poin', 'asc')->groupBy('dealer_id')->get();
        }
        if($sortby==3){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->with('dealers','bid_image')->orderBy('tp_curve_poin', 'asc')->groupBy('dealer_id')->get();
        }
        $dealer_userid=Session::get('dealer_userid');
        $RequestQueue_row=RequestQueue::where('id',$id)->first();
        return view('front.ajax.get_update_bid_dealers',compact('BidQueue','RequestQueue_row','dealer_userid'),array('title'=>'DEALERSDIRECT | Client Request Details'));
    }
    public function AcceptDealerBid(){
        $id=Request::input('requestid');
        $BidQueue=BidQueue::where('id',$id)->with('dealers','request_queues')->first();
        $BidAcceptanceQueue['dealer_id'] =$BidQueue->dealer_id;
        $BidAcceptanceQueue['client_id'] =$BidQueue->request_queues->client_id;
        $BidAcceptanceQueue['bid_id'] =$BidQueue->id;
        $BidAcceptanceQueue['request_id'] =$BidQueue->requestqueue_id;
        $BidAcceptanceQueue['details'] =Request::input('acceptdetails');

        $RequestQueue_row=RequestQueue::where('id',$BidQueue->requestqueue_id)->first();
        $RequestQueue_row->status=1;
        $RequestQueue_row->save();
        $BidAcceptanceQueue_row=BidAcceptanceQueue::create($BidAcceptanceQueue);
        $BidQueue=BidQueue::find($id);
        $BidQueue->status = 3;
        $BidQueue->save();
        self::SendAcceptancemail($id);
        return 1;
        
    }
    public function SendAcceptancemail($id=null){
            
            $BidQueue_row=BidQueue::where('id',$id)->with('dealers','request_queues')->first();
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $BidQueue_row->dealer_id)->where('request_id', $BidQueue_row->requestqueue_id)->first();
            $RequestQueue_row=RequestQueue::where('id',$BidQueue_row->requestqueue_id)->with('clients','makes','models')->first();
            
            $BidQueuecount=BidQueue::where('requestqueue_id' ,$BidQueue_row->requestqueue_id)->where('visable','=','1')->count();
            $dealer_email=$BidQueue_row->dealers->email;
            $dealer_name=$BidQueue_row->dealers->first_name." ".$BidQueue_row->dealers->last_name;
            $admin_users_email="hello@tier5.us";
            $project_make=$RequestQueue_row->makes->name;
            $project_model=$RequestQueue_row->models->name;
            $project_year=$RequestQueue_row->year;
            $project_conditions=$RequestQueue_row->condition;
            $project_bidcount=$BidQueuecount;
            $client_email=$RequestQueue_row->clients->email;
            $client_name=$RequestQueue_row->clients->first_name." ".$RequestQueue_row->clients->last_name;
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($RequestDealerLog->id);
            $activateLinkclient = url('/').'/client/request_detail/'.$BidQueue_row->requestqueue_id;
            $admin_users_email="hello@tier5.us";
            $sent = Mail::send('front.email.acceptbidLink', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLink, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount), 
            function($message) use ($admin_users_email, $dealer_email,$dealer_name)
            {
            $message->from($admin_users_email);
            $message->to($dealer_email, $dealer_name)->subject('Bid Request Accepted');
            });
            $senttoclient = Mail::send('front.email.acceptbidLinkclient', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLinkclient, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount), 
            function($message) use ($admin_users_email, $client_email,$client_name)
            {
            $message->from($admin_users_email);
            $message->to($client_email, $client_name)->subject('Bid Request Accepted');
            });

            return 1;
    }
    public function BidHistory(){

        $bid=Request::input('bid');
        $BidQueue_row=BidQueue::where('id',$bid)->first();
        $BidQueue_row->requestqueue_id;
        $BidQueue_row->dealer_id;
        $BidQueue=BidQueue::where('requestqueue_id', $BidQueue_row->requestqueue_id)->where('dealer_id', $BidQueue_row->dealer_id)->with('dealers','request_queues')->orderBy('visable', 'desc')->get();
       return view('front.ajax.bid_history',compact('BidQueue'));
        
    }
    public function BidHistoryDealers(){

        $bid=Request::input('bid');
        $BidQueue_row=BidQueue::where('id',$bid)->first();
        $BidQueue_row->requestqueue_id;
        $BidQueue_row->dealer_id;
        $dealer_userid=Session::get('dealer_userid');
        if($dealer_userid!=$BidQueue_row->dealer_id){
          $BidQueue=BidQueue::where('requestqueue_id', $BidQueue_row->requestqueue_id)->where('dealer_id', $BidQueue_row->dealer_id)->with('dealers','request_queues')->where('visable', '=',1)->get();  
        }
        else{
           $BidQueue=BidQueue::where('requestqueue_id', $BidQueue_row->requestqueue_id)->where('dealer_id', $BidQueue_row->dealer_id)->with('dealers','request_queues')->orderBy('visable', 'desc')->get(); 
        }
        
       return view('front.ajax.bid_history_dealers',compact('BidQueue'));
        
    }
    public function BlockDealerBid(){
        $id=print_r(Request::input());
        $BidQueue=BidQueue::where('id',$id)->first();
        
        $BidQueue->dealer_id;
        $BidQueue->request_id;
        $BlockBidLog['dealer_id'] =$BidQueue->dealer_id;
        $BlockBidLog['client_id'] =$BidQueue->request_queues->client_id;
        $BlockBidLog['bid_id'] =$BidQueue->id;
        $BlockBidLog['request_id'] =$BidQueue->requestqueue_id;
        $BlockBidLog['details'] =Request::input('blockdetails');
        $BlockBidLog_row=BlockBidLog::create($BlockBidLog);
        $RequestDealerLog=RequestDealerLog::where('dealer_id', $BidQueue->dealer_id)->where('request_id', $BidQueue->requestqueue_id)->first();
        $RequestDealerLog->blocked=1;
        $RequestDealerLog->save();
        $details_of_actions=Request::input('blockdetails');
        self::SendBlockemail($id,$details_of_actions);
        return 1;
    }
    public function SendBlockemail($id=null,$details=null){
            
            $BidQueue_row=BidQueue::where('id',$id)->with('dealers','request_queues')->first();
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $BidQueue_row->dealer_id)->where('request_id', $BidQueue_row->requestqueue_id)->first();
            $RequestQueue_row=RequestQueue::where('id',$BidQueue_row->requestqueue_id)->with('clients','makes','models')->first();
            
            $BidQueuecount=BidQueue::where('requestqueue_id' ,$BidQueue_row->requestqueue_id)->where('visable','=','1')->count();
            $dealer_email=$BidQueue_row->dealers->email;
            $dealer_name=$BidQueue_row->dealers->first_name." ".$BidQueue_row->dealers->last_name;
            $admin_users_email="hello@tier5.us";
            $project_make=$RequestQueue_row->makes->name;
            $project_model=$RequestQueue_row->models->name;
            $project_year=$RequestQueue_row->year;
            $project_conditions=$RequestQueue_row->condition;
            $project_bidcount=$BidQueuecount;
            $client_email=$RequestQueue_row->clients->email;
            $client_name=$RequestQueue_row->clients->first_name." ".$RequestQueue_row->clients->last_name;
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($RequestDealerLog->id);
            $activateLinkclient = url('/').'/client/request_detail/'.$BidQueue_row->requestqueue_id;
            $admin_users_email="hello@tier5.us";
            $sent = Mail::send('front.email.blockbidLink', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLink, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount,'client_name'=>$client_name,'details'=>$details), 
            function($message) use ($admin_users_email, $dealer_email,$dealer_name)
            {
            $message->from($admin_users_email);
            $message->to($dealer_email, $dealer_name)->subject('Bid Request Blocked');
            });
            $senttoclient = Mail::send('front.email.blockbidLinkclient', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLinkclient, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount,'dealer_name'=>$dealer_name,'details'=>$details), 
            function($message) use ($admin_users_email, $client_email,$client_name)
            {
            $message->from($admin_users_email);
            $message->to($client_email, $client_name)->subject('Bid Request Blocked');
            });

            return 1;
    }
    public function ClientRequest(){
        
        $client=Session::get('client_userid');
        $Client = Client::find($client);
         $year_search=Request::input('year_search');
         $make_search=Request::input('make_search');
         $model_search=Request::input('model_search');

        $tradein=Request::input('tradein');
        $trademake_search=Request::input('trademake_search');
        $trademodel_search=Request::input('trademodel_search');
        $tradecondition_search=Request::input('tradecondition_search');
        $tradeyear_search=Request::input('tradeyear_search');
        self::ApiGetImageNotStyle($make_search,$model_search,$year_search);
        
        $condition_search=Request::input('condition_search');
        
        $tamo=Request::input('tamo');
        $mtamo=Request::input('mtamo');
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
        $RequestQueue['im_type'] =1;
        if($tradein=="yes"){
        $RequestQueue['trade_in']=1;
        $TradeinRequest['make_id'] =$trademake_search;
        $TradeinRequest['carmodel_id'] =$trademodel_search;
        $TradeinRequest['condition'] =$tradecondition_search;
        $TradeinRequest['year'] =$tradeyear_search;
        $owe=Request::input('owe');
            if(isset($owe)){
                $TradeinRequest['owe'] =Request::input('owe');
                $TradeinRequest['owe_amount'] =Request::input('oweamount');

            }
        
        $TradeinRequest['fname'] =$Client->first_name;
        $TradeinRequest['lname'] =$Client->last_name;
        $TradeinRequest['phone'] =$Client->phone;
        $TradeinRequest['email'] =$Client->email;
        $TradeinRequest['client_id']=$Client->id;
        $TradeinRequest['im_type'] =0;
        $TradeinRequest['type'] =1;
        }
        $RequestQueue_row=RequestQueue::create($RequestQueue);
        $lastinsertedId = $RequestQueue_row->id;
        if(isset($TradeinRequest)){
            self::ApiGetImageNotStyle($trademake_search,$trademodel_search,$tradeyear_search);
            $TradeinRequest['im_type'] =1;
            
            $TradeinRequest['request_queue_id'] =$lastinsertedId;
            $TradeinRequest=TradeinRequest::create($TradeinRequest);
           
        }
        $DealerMakeMap = DealerMakeMap::where('make_id', $make_search)->get();
        foreach ($DealerMakeMap as $value) {
              $RequestDealerLog['dealer_id']=$value->dealer_id;
              $RequestDealerLog['request_id']=$lastinsertedId;
              $RequestDealerLog['make_id']=$make_search;
              $RequestDealerLog['status']=1;
              $RequestDealerLog_row=RequestDealerLog::create($RequestDealerLog);
              $lastlog = $RequestDealerLog_row->id;
              self::SendRemindermail($lastlog);
              
          }
          
          return $lastinsertedId;
    }
    public function SetTosignup(){
        $cachedata['make_search']=Request::input('make_search');
        $cachedata['model_search']=Request::input('model_search');
        $cachedata['condition_search']=Request::input('condition_search');
        $cachedata['year_search']=Request::input('year_search');
        $cachedata['tamo']=Request::input('tamo');
        $cachedata['mtamo']=Request::input('mtamo');
        $make_search=Request::input('make_search');
        $model_search=Request::input('model_search');
        $year_search=Request::input('year_search');
        

        $tradein=Request::input('tradein');
        $trademake_search=Request::input('trademake_search');
        $trademodel_search=Request::input('trademodel_search');
        $tradecondition_search=Request::input('tradecondition_search');
        $tradeyear_search=Request::input('tradeyear_search');
        $cachedata['tradein']=$tradein;
        if($tradein=="yes"){
        $cachedata['trade_in']=1;
        $cachedata['trademake_search'] =$trademake_search;
        $cachedata['trademodel_search'] =$trademodel_search;
        $cachedata['tradecondition_search'] =$tradecondition_search;
        $cachedata['tradeyear_search'] =$tradeyear_search;
        $cachedata['owe'] =0;
        $owe=Request::input('owe');
        if(isset($owe)){
        $cachedata['owe'] =Request::input('owe');
        $cachedata['owe_amount'] =Request::input('oweamount');

        }
        }
        self::ApiGetImageNotStyle($make_search,$model_search,$year_search);
        self::ApiGetImageNotStyle($trademake_search,$trademodel_search,$tradeyear_search);
        $cachedata['im_type'] =1;
        Session::put('cachedata',$cachedata);
        return 1;
    }
    public function AddImageOptions(){
        return view('front.ajax.add_image_options');
    }
    public function CheckDealersStatus(){
        $id=Session::get('dealer_userid');
        $Dealer=Dealer::find($id);
        return $Dealer->status;
    }
    public function ApiGetImageNotStyle($Makes=null,$Models=null,$Year=null){
        
        $Make=Make::find($Makes);
        $Model=Carmodel::find($Models);
        $EdmundsMakeModelYearImagecount=EdmundsMakeModelYearImage::where('make_id',$Make->id)->where('model_id',$Model->id)->where('year_id',$Year)->count();
        if($EdmundsMakeModelYearImagecount==0){
         $url = "https://api.edmunds.com/api/media/v2/".$Make->nice_name."/".$Model->nice_name."/".$Year."/photos?view=full&fmt=json&api_key=meth499r2aepx8h7c7hcm9qz";
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        $resuls=json_decode($result, true);
        
        foreach ($resuls['photos'] as $photoskey => $photos) {
                    $makephoto['make_id']=$Make->id;
                    $makephoto['model_id']=$Model->id;
                    $makephoto['year_id']=$Year;
                    $makephoto['title']=$photos['title'];
                    $makephoto['category']=$photos['category'];
                    foreach ($photos['sources'] as $sources) {
                        if($sources['size']['width']=="500"){
                                $makephoto['edmunds_path_big']=$sources['link']['href'];
                            }
                        if($sources['size']['width']=="1600"){
                            $makephoto['edmunds_path_big']=$sources['link']['href'];
                        }
                        
                        if($sources['size']['width']=="276"){
                            $makephoto['edmunds_path_small']=$sources['link']['href'];
                        }

                        
                    }
                    if(!isset($makephoto['edmunds_path_big'])){
                        

                        foreach ($photos['sources'] as $sourcesx) {
                            if($sourcesx['size']['width']==$photos['originalSize']['width']){
                                $makephoto['edmunds_path_big']=$sourcesx['link']['href'];
                            }
                        }
                        
                    }
                        $bcontent = file_get_contents("https://media.ed.edmunds-media.com".$makephoto['edmunds_path_big']);
                        $bnpath=time().".jpg";
                        $bigpathe="public/edmunds/make/big/".$bnpath;
                        $fbp = fopen($bigpathe, "w");
                        fwrite($fbp, $bcontent);
                        fclose($fbp);

                        $scontent = file_get_contents("https://media.ed.edmunds-media.com".$makephoto['edmunds_path_small']);
                        $smpath=time().".jpg";
                        $smallpathe="public/edmunds/make/small/".$smpath;
                        $fsp = fopen($smallpathe, "w");
                        fwrite($fsp, $scontent);
                        fclose($fsp);
                        $makephoto['local_path_big']=$bnpath;
                        $makephoto['local_path_smalll']=$smpath;
                    EdmundsMakeModelYearImage::create($makephoto);

                }

                }

    }
}
