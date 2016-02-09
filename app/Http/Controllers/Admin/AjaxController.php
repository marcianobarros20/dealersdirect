<?php

namespace App\Http\Controllers\Admin;

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
    public function getOptionDetails(){
    	$id=Request::input('requestid');
    	$RequestStyleEngineTransmissionColor=RequestStyleEngineTransmissionColor::with('styles','engines','transmission','excolor','incolor')->find($id);
    	//dd($RequestStyleEngineTransmissionColor);
    	return view('admin.ajax.get_options_details',compact('RequestStyleEngineTransmissionColor'));
    }
    public function getClientDetails(){
    	$id=Request::input('requestid');
    	$Client=Client::find($id);
    	//dd($RequestStyleEngineTransmissionColor);
    	return view('admin.ajax.get_clients_details',compact('Client'));
    }
    public function getGuestClientDetails(){
    	$id=Request::input('requestid');
    	$RequestQueue=RequestQueue::find($id);
    	//dd($RequestStyleEngineTransmissionColor);
    	return view('admin.ajax.get_guest_clients_details',compact('RequestQueue'));
    }
    public function getbiddetails(){
    	$id=Request::input('requestid');
    	$BidQueue=BidQueue::where('requestqueue_id',$id)->with('dealers','request_queues','bid_image','bid_acceptance_log','bid_blocked_log')->get();
    	foreach ($BidQueue as $key => $bid) {
    		$RequestDealerLog=RequestDealerLog::where('dealer_id', $bid->dealer_id)->where('request_id', $bid->requestqueue_id)->first();
    		$RequestDealerLogcount=RequestDealerLog::where('dealer_id', $bid->dealer_id)->where('request_id', $bid->requestqueue_id)->count();
    		if($RequestDealerLogcount==0){$BidQueue[$key]['blocked']=0;}else{
    		$BidQueue[$key]['blocked']=$RequestDealerLog->blocked;}
    	}
    	//dd($BidQueue);
    	return view('admin.ajax.get_bid_details',compact('BidQueue'));
    }
    public function activateDealer() {
        $id=base64_decode(Request::input('requestid'));
        $Dealer=Dealer::find($id);
        $Dealer->status=1;
        $Dealer->save();
        return 1;
    }
    public function deactivateDealer(){
        $id=base64_decode(Request::input('requestid'));
        $Dealer=Dealer::find($id);
        $Dealer->status=0;
        $Dealer->save();
        return 1;
    }
}
