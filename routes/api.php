<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/admin/login', 'AuthController@adminLogin');
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/me', 'AuthController@adminMe');
    Route::get('/admin/notice/unread', 'NoticesController@getUnreadAdmin');
    Route::get('/admin/users/list', 'UsersController@getUserslist');
    Route::get('/admin/users/detail/{id}', 'UsersController@getUserDetail')->where(['id' => '[0-9]']);
    Route::post('/admin/users/save', 'UsersController@save');
    Route::get('/admin/schedule/monthly/{year}/{month}', 'SchedulesController@getAdminMonthly')->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}'
    ]);
    Route::get('/admin/schedule/daily/{year}/{month}/{day}', 'SchedulesController@getAdminDaily')->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}',
        'day' => '[0-9]{2}'
    ]);
});

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::post('/password/reset/request', 'UsersController@sendResetLinkEmail');
Route::post('/password/reset', 'UsersController@resetPassword');

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('/me', 'AuthController@me');
    Route::get('/schedule/monthly/{year}/{month}', 'SchedulesController@getMonthly')->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}'
    ]);
    Route::get('/schedule/daily/{year}/{month}/{day}', 'SchedulesController@getDaily')->where([
        'year' => '[0-9]{4}',
        'month' => '[0-9]{2}',
        'day' => '[0-9]{2}'
    ]);
    Route::post('/schedule/reserve', 'SchedulesController@reserve');
    Route::post('/contact/read', 'ContactsController@setRead');
    Route::post('/contact/save', 'ContactsController@save');
    Route::get('/contact/general', 'ContactsController@getGeneralContacts');
    Route::get('/contact/general/all', 'ContactsController@getGeneralContactsAll');
    Route::get('/notice', 'NoticesController@getUnread');
    Route::get('/notice/all', 'NoticesController@getAll');
    Route::post('/notice/read', 'NoticesController@setRead');
});

Route::any('/{any}', function() {
    return response()->json(['message' => 'API Not Found'], 404);
})->where('any', '.*');