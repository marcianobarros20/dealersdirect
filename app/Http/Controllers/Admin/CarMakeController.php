<?php


namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Input; /* For input */
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
use Validator;
use Session;
use DB;
use Mail;
use Hash;
use Auth;
use Imagine\Image\Box;
use Image\Image\ImageInterface;
use App\Helper\helpers;
class CarMakeController extends Controller
{
    var $obj;
    //
    public function getMake(){

    	$Makes=Make::all();

    	return view('admin.make.make_list',compact('Makes'),array('title'=>'Dealers Direct Admin | Make List'));

    }
    public function addMakeimage($id=null){
        $id=base64_decode($id);
        $Makes=Make::where('makes_id',$id)->first();
        
        return view('admin.make.make_add_image',compact('Makes'),array('title'=>'Dealers Direct Admin | Make Add Images'));
    }
    public function saveMakeimage(){
    	$obj = new helpers();
		$this->obj = $obj;
    	$id=Request::input('id');
    	if(Request::hasFile('makeimg')){
    		
			echo $makeimg = Request::file('makeimg');
			$extension =$makeimg->getClientOriginalExtension();
			$destinationPath = 'public/uploads/carmake/';   // upload path
					$thumb_path = 'public/uploads/carmake/thumb/';
					$medium = 'public/uploads/carmake/medium/';
					$home_thumb_path = 'public/uploads/carmake/home_thumb/';
			$extension =$makeimg->getClientOriginalExtension(); // getting image extension
			$fileName = rand(111111111,999999999).'.'.$extension; // renameing image
			$makeimg->move($destinationPath, $fileName); // uploading file to given path

			$this->obj->createThumbnail($fileName,260,167,$destinationPath,$thumb_path);
			$this->obj->createThumbnail($fileName,850,455,$destinationPath,$medium);
			$this->obj->createThumbnail($fileName,1920,900,$destinationPath,$home_thumb_path);

			$Makes=Make::where('makes_id',$id)->first();
			$Makes->image=$fileName;
			$Makes->save();
			return redirect('/admin/make');
    	}
    }
    public function updateMakeimage($id=null){
        $id=base64_decode($id);
        $Makes=Make::where('makes_id',$id)->first();
        
        return view('admin.make.make_update_image',compact('Makes'),array('title'=>'Dealers Direct Admin | Make Update Images'));
    }
    public function saveupdateMakeimage(){
    	$obj = new helpers();
		$this->obj = $obj;
    	$id=Request::input('id');
    	if(Request::hasFile('makeimg')){
    		
			echo $makeimg = Request::file('makeimg');
			$extension =$makeimg->getClientOriginalExtension();
			$destinationPath = 'public/uploads/carmake/';   // upload path
					$thumb_path = 'public/uploads/carmake/thumb/';
					$medium = 'public/uploads/carmake/medium/';
					$home_thumb_path = 'public/uploads/carmake/home_thumb/';
			$extension =$makeimg->getClientOriginalExtension(); // getting image extension
			$fileName = rand(111111111,999999999).'.'.$extension; // renameing image
			$makeimg->move($destinationPath, $fileName); // uploading file to given path

			$this->obj->createThumbnail($fileName,260,167,$destinationPath,$thumb_path);
			$this->obj->createThumbnail($fileName,850,455,$destinationPath,$medium);
			$this->obj->createThumbnail($fileName,1920,900,$destinationPath,$home_thumb_path);

			
			
			
    	}
    	else{
    		$fileName=Request::input('im');
    		
    	}
    	
    		$Makes=Make::where('makes_id',$id)->first();
			$Makes->image=$fileName;
			$Makes->save();
			return redirect('/admin/make');
    }
}
