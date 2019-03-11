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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
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
    Route::post('/schedule/create', 'SchedulesController@create');
    Route::post('/comment/read', 'CommentsController@setRead');
    Route::post('/comment/save', 'CommentsController@save');
});

Route::any('{all}', function() {
    return App::abort(404);
});