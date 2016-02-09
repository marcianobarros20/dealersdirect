<?php
namespace App\Http\Controllers\Admin;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Input; /* For input */
use Validator;
use Session;
use DB;
use Mail;
use Hash;
use Auth;
use Imagine\Image\Box;
use Image\Image\ImageInterface;
use App\Helper\helpers;
use App\Model\SiteContactPrice;                    /* Model name*/
class PriceController extends Controller
{
 public function getIndex(){
 $data_msg=array('title' => 'Dealers Direct Admin | Set Price','module_head'=>'Price List');
 $data_msg['get_price']=SiteContactPrice::all();
 return \View::make('admin.price.price_index',$data_msg);
 }

 public function AddPrice(Request $request){
 	if(isset($_POST['add_price'])){
 		$added_by=Auth::user()->name;
 		$price = new SiteContactPrice;
 		$price->added_by = $added_by;
        $price->price = Request::input('price');
        $price->save();
 		return \Redirect::back()->with('success','New Price Added');
 		}
 	}

 public function EditPrice($id=NULL){
 	$price =SiteContactPrice::find($id);
 	return \View::make('admin.ajax.edit-price',compact('price'));
 	}

 public function EditPricePost(){
 	if(isset($_POST['edt_price'])){
 		$added_by=Auth::user()->name;
 		$id = Request::input('p_id');
 		$price =SiteContactPrice::find($id);
 		$price->price = Request::input('price');
 		$price->added_by = $added_by;
 		$price->update();
 		}

 		return \Redirect::to('/admin/price')->with('success','Price Updated');
 	}

 	public function DeletePrice($id=NULL){
 		$price =SiteContactPrice::find($id)->delete();
 		return \Redirect::to('/admin/price')->with('success','Price Deleted');
 	}
}