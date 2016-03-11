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
        $RequestQueue_row=RequestQueue::create($RequestQueue);
        $lastinsertedId = $RequestQueue_row->id;
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
        //echo "Done";
        Session::forget('guest_user');
        Session::put('guest_user', $lastinsertedId);
        //return view('front.ajax.create_year_types',compact('Caryear'));
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
            $admin_users_email="prodip211085@gmail.com";
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($maskval);
            
            $sent = Mail::send('front.email.activateLink', array('name'=>$user_name,'email'=>$user_email,'activate_link'=>$activateLink, 'make'=>$requestqueuex['make'],'model'=>$requestqueuex['model'],'year'=>$requestqueuex['year'],'conditions'=>$requestqueuex['conditions']), 
            function($message) use ($admin_users_email, $user_email,$user_name)
            {
            $message->from($admin_users_email);
            $message->to($user_email, $user_name)->subject('Welcome to Dealers Direct');
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
        print_r(Request::input());
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
            $AverageTp=$AverageTp/$tbid;
            $AverageMp=$AverageMp/$tbid;
            foreach ($BidQueuex as $key => $bid) {
                
               
                $BidQueuenew = BidQueue::find($bid->id);
                $BidQueuenew->tp_curve_poin = (($bid->total_amount-$AverageTp)/$AverageTp)*100;
                $BidQueuenew->mp_curve_poin = (($bid->monthly_amount-$AverageMp)/$AverageMp)*100;
                $BidQueuenew->acc_curve_poin = ((((($bid->total_amount-$AverageTp)/$AverageTp)*100)*.5)+(((($bid->monthly_amount-$AverageMp)/$AverageMp)*100)*.5))/2;
                $BidQueuenew->save();

            }
            $details_of_actions=Request::input('rejectdetails');
            self::SendRejectemail($id,$details_of_actions);
            return 1;


    }
    public function SendRejectemail($id=null,$details=null){
            
            $BidQueue_row=BidQueue::where('id',$id)->with('dealers','request_queues')->first();
            $RequestDealerLog=RequestDealerLog::where('dealer_id', $BidQueue_row->dealer_id)->where('request_id', $BidQueue_row->requestqueue_id)->first();
            $RequestQueue_row=RequestQueue::where('id',$BidQueue_row->requestqueue_id)->with('clients','makes','models')->first();
            
            $BidQueuecount=BidQueue::where('requestqueue_id' ,$BidQueue_row->requestqueue_id)->where('visable','=','1')->count();
            $dealer_email=$BidQueue_row->dealers->email;
            $dealer_name=$BidQueue_row->dealers->first_name." ".$BidQueue_row->dealers->last_name;
            $admin_users_email="prodip211085@gmail.com";
            $project_make=$RequestQueue_row->makes->name;
            $project_model=$RequestQueue_row->models->name;
            $project_year=$RequestQueue_row->year;
            $project_conditions=$RequestQueue_row->condition;
            $project_bidcount=$BidQueuecount;
            $client_email=$RequestQueue_row->clients->email;
            $client_name=$RequestQueue_row->clients->first_name." ".$RequestQueue_row->clients->last_name;
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($RequestDealerLog->id);
            $activateLinkclient = url('/').'/client/request_detail/'.$BidQueue_row->requestqueue_id;
            $admin_users_email="prodip211085@gmail.com";
            $sent = Mail::send('front.email.rejectbidLink', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLink, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount,'client_name'=>$client_name,'details'=>$details), 
            function($message) use ($admin_users_email, $dealer_email,$dealer_name)
            {
            $message->from($admin_users_email);
            $message->to($dealer_email, $dealer_name)->subject('Welcome to Dealers Direct');
            });
            $senttoclient = Mail::send('front.email.rejectbidLinkclient', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLinkclient, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount,'dealer_name'=>$dealer_name,'details'=>$details), 
            function($message) use ($admin_users_email, $client_email,$client_name)
            {
            $message->from($admin_users_email);
            $message->to($client_email, $client_name)->subject('Welcome to Dealers Direct');
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
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->where('visable','=','1')->with('dealers')->orderBy('acc_curve_poin', 'asc')->get();
        }
        if($sortby==2){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->where('visable','=','1')->with('dealers')->orderBy('mp_curve_poin', 'asc')->get();
        }
        if($sortby==3){
            $BidQueue=BidQueue::where('requestqueue_id', $id)->where('status','!=','2')->whereIn('dealer_id', $RequestDealerLog_row)->where('visable','=','1')->with('dealers')->orderBy('tp_curve_poin', 'asc')->get();
        }
        $RequestQueue_row=RequestQueue::where('id',$id)->first();
        return view('front.ajax.get_update_bid',compact('BidQueue','RequestQueue_row'),array('title'=>'DEALERSDIRECT | Client Request Details'));
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
            $admin_users_email="prodip211085@gmail.com";
            $project_make=$RequestQueue_row->makes->name;
            $project_model=$RequestQueue_row->models->name;
            $project_year=$RequestQueue_row->year;
            $project_conditions=$RequestQueue_row->condition;
            $project_bidcount=$BidQueuecount;
            $client_email=$RequestQueue_row->clients->email;
            $client_name=$RequestQueue_row->clients->first_name." ".$RequestQueue_row->clients->last_name;
            $activateLink = url('/').'/dealers/request_detail/'.base64_encode($RequestDealerLog->id);
            $activateLinkclient = url('/').'/client/request_detail/'.$BidQueue_row->requestqueue_id;
            $admin_users_email="prodip211085@gmail.com";
            $sent = Mail::send('front.email.acceptbidLink', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLink, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount), 
            function($message) use ($admin_users_email, $dealer_email,$dealer_name)
            {
            $message->from($admin_users_email);
            $message->to($dealer_email, $dealer_name)->subject('Welcome to Dealers Direct');
            });
            $senttoclient = Mail::send('front.email.acceptbidLinkclient', array('dealer_name'=>$dealer_name,'email'=>$dealer_email,'activateLink'=>$activateLinkclient, 'project_make'=>$project_make,'model'=>$project_model,'year'=>$project_year,'conditions'=>$project_conditions,'project_bidcount'=>$project_bidcount), 
            function($message) use ($admin_users_email, $client_email,$client_name)
            {
            $message->from($admin_users_email);
            $message->to($client_email, $client_name)->subject('Welcome to Dealers Direct');
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
    public function BlockDealerBid(){
        $id=Request::input('requestid');
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
        return 1;
    }
}
