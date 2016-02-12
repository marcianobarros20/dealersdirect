<?php

namespace App\Http\Controllers\Front;

use App\Model\Make;          /* Model name*/
use App\Model\Carmodel;          /* Model name*/
use App\Model\Caryear;          /* Model name*/
use App\Model\RequestQueue;		/* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Input;
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
        //echo "<pre>";
        //print_r($Caryear);


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
		RequestQueue::create($RequestQueue);
        

echo "Done";
        //return view('front.ajax.create_year_types',compact('Caryear'));

        
    }
}
