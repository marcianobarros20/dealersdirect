<?php

namespace App\Http\Controllers\Admin;

use App\Model\Make;                                         /* Model name*/
use App\Model\Dealer;                                       /* Model name*/
use App\Model\DealerMakeMap;                                /* Model name*/
use App\Model\RequestDealerLog;                             /* Model name*/
use App\Model\Carmodel;                                     /* Model name*/
use App\Model\RequestQueue;                                 /* Model name*/
use App\Model\RequestStyleEngineTransmissionColor;          /* Model name*/
use App\Model\BidQueue;                                     /* Model name*/
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

class DealerController extends Controller
{
    //
    public function getDealer(){
    	$Dealers=Dealer::all();

    	return view('admin.dealer.dealer_list',compact('Dealers'),array('title'=>'Dealers Direct Admin | Dealer List'));
    }
}
