<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'Front\HomeController@index');

Route:: get('/api-edmunds-make','Admin\ApiController@apimake');
Route:: get('/api-edmunds-model','Admin\ApiController@apimodel');

Route::post('/ajax/get_model', 'Front\AjaxController@getmodel');
Route::post('/ajax/get_year', 'Front\AjaxController@getyear');
Route::post('ajax/requirment_queue', 'Front\AjaxController@requirmentqueue');


Route:: get('/dealers', 'Front\DealerController@index');
Route:: get('/dealer-signin', 'Front\DealerController@signin');
Route:: post('/dealer-signin', 'Front\DealerController@signin');
Route:: get('/dealer-signup', 'Front\DealerController@signup');
Route:: post('/dealerregister','Front\RegisterController@dealerRegister');
Route:: get('/dealer-dashboard', 'Front\DealerController@dashboard');
Route:: get('/dealer_sign_out', 'Front\DealerController@signout');
Route:: get('/dealers/request_list', 'Front\DealerController@requestList');
Route:: get('dealers/request_detail/{id}', 'Front\DealerController@requestDetail');
Route:: get('/dealer/dealer_make', 'Front\DealerController@DealerMakeList');
Route:: get('dealers/dealer_add_make', 'Front\DealerController@DealerMakeAdd');
Route:: post('/dealeraddmake', 'Front\DealerController@DealerAddMake');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
