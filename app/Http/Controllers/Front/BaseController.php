<?php namespace App\Http\Controllers\Front; /* path of this controller*/


use App\Model\Make;          /* Model name*/
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input; /* For input */
use Validator;
use Session;
use Illuminate\Pagination\Paginator;
use DB;

use App\Helper\helpers;



class BaseController extends Controller {

	public function __construct() 
    {
    	
        $Makes=[''=>'Select Make']+Make::lists('name', 'id')->all();
       
        
	    view()->share('Makes',$Makes);

       
        
    }

    public function index(){
    	
    }
   
   

}
