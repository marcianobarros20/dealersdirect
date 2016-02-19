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
/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/', 'Front\HomeController@index');
Route::get('/request_success', 'Front\HomeController@RequestSuccess');
/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/clientregister', 'Front\HomeController@ClientRegister');
Route::get('/client-dashboard', 'Front\ClientController@Dashboard');
Route::get('/client_sign_out', 'Front\ClientController@signout');
Route:: get('/client-signin', 'Front\ClientController@signin');
Route:: post('/client-signin', 'Front\ClientController@signin');
Route:: get('/client/profile', 'Front\ClientController@profile');
Route:: post('/clienteditdetails', 'Front\ClientController@ProfileEditDetails');
Route:: post('/clienteditpassword', 'Front\ClientController@ProfileEditPassword');
Route:: get('/client/request_list', 'Front\ClientController@requestList');
Route:: get('/client/request_detail/{id}', 'Front\ClientController@requestDetail');
Route:: get('/testmailnew', 'Front\ClientController@testmailnew');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/
Route:: get('/api-edmunds-make','Admin\ApiController@apimake');
Route:: get('/api-edmunds-model','Admin\ApiController@apimodel');
Route:: get('/api-edmunds-style-id','Admin\ApiController@apistyleid');
Route:: get('/api-edmunds-style-generator','Admin\ApiController@apistylegenerator');
/*
|--------------------------------------------------------------------------
| Front Ajax Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/ajax/get_model', 'Front\AjaxController@getmodel');
Route::post('/ajax/get_year', 'Front\AjaxController@getyear');
Route::post('ajax/requirment_queue', 'Front\AjaxController@requirmentqueue');

/*
|--------------------------------------------------------------------------
| Dealer Routes
|--------------------------------------------------------------------------
|
*/
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
Route:: post('/ajax/delete_dealer_make', 'Front\AjaxController@deletedealermake');
Route:: get('/dealer/profile', 'Front\DealerController@profile');
Route:: post('/dealereditdetails', 'Front\DealerController@ProfileEditDetails');
Route:: post('/dealereditpassword', 'Front\DealerController@ProfileEditPassword');


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
