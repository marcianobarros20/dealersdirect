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
