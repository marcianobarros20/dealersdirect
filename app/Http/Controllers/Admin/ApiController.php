<?php

namespace App\Http\Controllers\Admin;
use App\Model\Make;          /* Model name*/
use App\Model\Carmodel;          /* Model name*/
use App\Model\Caryear;          /* Model name*/
use App\Model\Style;          /* Model name*/
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

				$Make['makes_id'] =$value['id'];
				$Make['name'] =$value['name'];
				$Make['nice_name'] =$value['niceName'];
				$Make['models'] =json_encode($value['models'],true);
				Make::create($Make);

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
		public function apistyleid(){
			
			// $Caryear=Caryear::where('id',1)->with('models','makes')->get();
			$Caryear=Caryear::all();
			foreach ($Caryear as  $value) {
				
				$url='https://api.edmunds.com/api/vehicle/v2/'.$value->makes->nice_name.'/'.$value->models->nice_name.'/'.$value->year.'?fmt=json&api_key=meth499r2aepx8h7c7hcm9qz';
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

					
					$count=Style::where('style_id'=>$styles['id'])->count();
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
		public function apistylegenerator(){
			echo "<pre>";
			$Caryear=Caryear::all();


			print_r($Caryear);
		}
}
