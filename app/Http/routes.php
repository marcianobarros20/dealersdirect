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
Route::get('/request_success/{id}', 'Front\HomeController@RequestSuccess');
Route::get('/refresh-token', function(){
    return csrf_token();
});
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
Route:: get('/client/add-style/{id}', 'Front\ClientController@AddStyle');
Route:: get('/client/add-engine/{id}', 'Front\ClientController@AddEngine');
Route:: get('/client/add-transmission/{id}', 'Front\ClientController@AddTransmission');
Route:: get('/client/add-color-exterior/{id}', 'Front\ClientController@AddColorExterior');
Route:: get('/client/add-color-interior/{id}', 'Front\ClientController@AddColorInterior');
Route:: get('/signin-client', 'Front\ClientController@SigninClient');
Route:: post('/signin-client', 'Front\ClientController@SigninClient');
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
| Admin Routes
|--------------------------------------------------------------------------
|
*/
Route::get('admin', function () {
  return redirect('/admin/home');
});
$router->group([
  'namespace' => 'Admin',
  'middleware' => 'auth',
], function () {
	
    Route::resource('admin/post', 'PostController');

    Route::resource('admin/home', 'HomeController');
    Route::resource('admin/admin-profile', 'HomeController@getProfile');
    Route::resource('admin/change-password', 'HomeController@changePass');
    Route::resource('admin/make', 'CarMakeController@getMake');
    Route::get('/admin/make/add_image/{id}', 'CarMakeController@addMakeimage');
    Route::post('/admin/make/add_image/', 'CarMakeController@saveMakeimage');
    Route::get('/admin/make/update_image/{id}', 'CarMakeController@updateMakeimage');
    Route::post('/admin/make/update_image/', 'CarMakeController@saveupdateMakeimage');
    Route::resource('/admin/model', 'CarModelController@getModel');
    Route::resource('/admin/year', 'CarYearController@getYear');
    Route::resource('/admin/dealers', 'DealerController@getDealer');
    Route::resource('/admin/request', 'RequestController@getRequest');

    Route::post('/admin/ajax/getoptiondetails', 'AjaxController@getOptionDetails');
    Route::post('/admin/ajax/getclientdetails', 'AjaxController@getClientDetails');
    Route::post('/admin/ajax/getguestclientdetails', 'AjaxController@getGuestClientDetails');
    Route::post('/admin/ajax/getbiddetails', 'AjaxController@getbiddetails');
    Route::post('/admin/ajax/activatedealer', 'AjaxController@activateDealer');
    Route::post('/admin/ajax/deactivatedealer', 'AjaxController@deactivateDealer');
});

// Logging in and out
Route::get('/auth/login', 'Auth\AuthController@getLogin');
Route::post('/auth/login', 'Auth\AuthController@postLogin');
Route::get('/auth/logout', 'Auth\AuthController@getLogout');



// admin/test
Route::group(
    array('prefix' => 'admin'), 
    function() {
        Route::get('forgotpassword', 'Admin\HomeController@forgotPassword');
        Route::post('forgotpasswordcheck', 'Admin\HomeController@forgotpasswordcheck');
        Route::get('resetpassword/{id}', 'Admin\HomeController@resetpassword');
        Route::post('updatepassword/{id}', 'Admin\HomeController@updatePassword');

    }
);
/*
|--------------------------------------------------------------------------
| Front Ajax Routes
|--------------------------------------------------------------------------
|
*/
Route::post('/ajax/get_model', 'Front\AjaxController@getmodel');
Route::post('/ajax/get_year', 'Front\AjaxController@getyear');
Route::post('/ajax/requirment_queue', 'Front\AjaxController@requirmentqueue');
Route::post('/ajax/addstyletorequestqueue', 'Front\AjaxController@AddStyleToRequestqueue');
Route::post('/ajax/addenginetorequestqueue', 'Front\AjaxController@AddEngineToRequestqueue');
Route::post('/ajax/addtranstorequestqueue', 'Front\AjaxController@AddTransmissionToRequestqueue');
Route::post('/ajax/addexcolortorequestqueue', 'Front\AjaxController@AddExteriorColorToRequestqueue');
Route::post('/ajax/addincolortorequestqueue', 'Front\AjaxController@AddInteriorColorToRequestqueue');
Route::post('/ajax/bidreject', 'Front\AjaxController@RejectDealerBid');
Route::post('/ajax/getupdatedbid', 'Front\AjaxController@GetUpdatedBid');
Route::post('/ajax/bidaccept/', 'Front\AjaxController@AcceptDealerBid');
Route::post('/ajax/bidhistory/', 'Front\AjaxController@BidHistory');
Route::post('/ajax/bidblock/', 'Front\AjaxController@BlockDealerBid');
Route::post('/ajax/client-request', 'Front\AjaxController@ClientRequest');
Route::post('/ajax/setto-signup', 'Front\AjaxController@SetTosignup');
Route::post('/ajax/add-image-option','Front\AjaxController@AddImageOptions');
Route::post('/ajax/checkdealersstatus','Front\AjaxController@CheckDealersStatus');
Route::post('/ajax/getupdatedbiddealer', 'Front\AjaxController@GetUpdatedBidDealer');
Route::post('ajax/bidhistory_dealers/', 'Front\AjaxController@BidHistoryDealers');
Route::post('/ajax/ApiGetImageNotStyle/{make}/{mode}/{year}','Front\AjaxController@ApiGetImageNotStyle');
/*
|--------------------------------------------------------------------------
| Dealer Routes
|--------------------------------------------------------------------------
|
*/
Route:: get('dealers/calculate_bid_curve/{id}', 'Front\DealerController@CalculateBidCurve');
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
Route:: get('/dealers/post-bid/{id}', 'Front\DealerController@postBid');
Route:: get('/dealers/edit-bid/{id}', 'Front\DealerController@editBid');
Route:: post('/postbid/', 'Front\DealerController@SaveBid');
Route:: post('/dealers/edit-bid', 'Front\DealerController@SaveEditBid');
Route:: get('/testemail/{id}', 'Front\AjaxController@SendAcceptancemail');
Route:: get('/dealers/blocked', 'Front\DealerController@BlockAction');
Route:: get('/dealers/stop-bid/{id}', 'Front\DealerController@DealerStopBid');
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
