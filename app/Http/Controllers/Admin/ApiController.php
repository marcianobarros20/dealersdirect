<?php

namespace App\Http\Controllers\Admin;
use App\Model\Make;          		/* Model name*/
use App\Model\Carmodel;          	/* Model name*/
use App\Model\Caryear;          	/* Model name*/
use App\Model\Style;          		/* Model name*/
use App\Model\State;          		/* Model name*/
use App\Model\City; 				/* Model name*/
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;



use Image\Image\ImageInterface;
use Illuminate\Pagination\Paginator;
use DB;
use App\Helper\helpers;

class ApiController extends Controller
{
    //

    	public function apistate()
		{
			
			
			$url = "http://iamrohit.in/lab/php_ajax_country_state_city_dropdown/api.php?type=getStates&countryId=231";
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			$resuls=json_decode($result, true);
			foreach ($resuls['result'] as $key => $value) {
				$count=State::where('id',$key)->count();
				if($count==0){
				$State['id'] =$key;
				$State['state'] =$value;
				State::create($State);
				}

			}
				
		}
		public function apicity()
		{
			
			$States=State::all();
			foreach ($States as $key => $State) {
				
				$url = "http://iamrohit.in/lab/php_ajax_country_state_city_dropdown/api.php?type=getCities&stateId=".$State->id;

				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
				curl_close($ch);
				$resuls=json_decode($result, true);
				foreach ($resuls['result'] as $key => $value) {
					$count=City::where('id',$key)->where('state_id',$State->id)->count();
					if($count==0){
						$City['id'] =$key;
						$City['state_id'] =$State->id;
						$City['city'] =$value;
						City::create($City);
					}
				}
			}
				
		}

		public function apimake()
		{
			
			//echo "hi";
			$url = "https://api.edmunds.com/api/vehicle/v2/makes?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz&state=new&view=full";
			
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			$resuls=json_decode($result, true);

				foreach ($resuls['makes'] as $key => $value) {
				$count=Make::where('makes_id',$value['id'])->count();
					if($count==0){
						$Make['makes_id'] =$value['id'];
						$Make['name'] =$value['name'];
						$Make['nice_name'] =$value['niceName'];
						$Make['models'] =json_encode($value['models'],true);
						Make::create($Make);
					}
				}
		}

		public function apimodel()
		{
			$Makes=Make::all();
			//$Makes=Make::where('id',1)->get();
			//echo "<pre>";
			//print_r($Makes);
			foreach ($Makes as $Make) {
				 $Make->makes_id;
				 $Make->name;
				 $Make->nice_name;
				  $url='https://api.edmunds.com/api/vehicle/v2/'.$Make->nice_name.'/models?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
				curl_close($ch);
				$resuls=json_decode($result, true);
				
				echo "<pre>";
				foreach ($resuls['models'] as $key => $value) {
						$count=Carmodel::where('model_id',$value['id'])->count();
							if($count==0){
								$Carmodel['model_id'] =$value['id'];
								$Carmodel['name'] =$value['name'];
								$Carmodel['nice_name'] =$value['niceName'];
								$Carmodel['years'] =json_encode($value['years'],true);
								$Carmodel['make_id'] =$Make->id;
								print_r($value['years']);
								print_r($Carmodel);
								$Carmodel_row=Carmodel::create($Carmodel);
								$lastinsertedId = $Carmodel_row->id;
								foreach ($value['years'] as $years) {
								$count=Caryear::where('year_id',$years['id'])->count();
									if($count==0){	
										$Caryear['make_id'] =$Make->id;
										$Caryear['carmodel_id'] =$lastinsertedId;
										$Caryear['year_id'] =$years['id'];
										$Caryear['year'] =$years['year'];
										$Caryear['styles'] =json_encode($years['styles'],true);
										$Caryear_row=Caryear::create($Caryear);
									}
								}
							}


				}

			}
			
		}
		public function apistyleid(){
			
			set_time_limit(3600);
			$Caryear=Caryear::all();
			foreach ($Caryear as  $value) {
				
				$url='https://api.edmunds.com/api/vehicle/v2/'.$value->makes->nice_name.'/'.$value->models->nice_name.'/'.$value->year.'?fmt=json&api_key=zxccg2zf747xeqvmuyxk9ht2';
				$ch = curl_init();
				curl_setopt($ch,CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$result = curl_exec($ch);
				curl_close($ch);
				$resuls=json_decode($result, true);
				if(isset($resuls['styles'])){
					foreach ($resuls['styles'] as $styles) {

					
					$count=Style::where('style_id',$styles['id'])->count();
					if($count==0){
							$Style['year_id'] =$value->id;
							$Style['style_id'] =$styles['id'];
							$Style['name'] =$styles['name'];
							$Style['body'] =$styles['submodel']['body'];
							$Style['trim'] =$styles['trim'];
							$Style['submodel'] =json_encode($value['submodel'],true);
							Style::create($Style);
					}
					

					}
				}

			}
			//print_r($Caryear);
		}
		
}
