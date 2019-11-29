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

Route::group(['namespace' => 'Subscribe', 'prefix' => 'subscribe'], function () {

  Route::post('/', 'SubscribeController@store')->name('public.subscribe.store');
});

Route::group(['namespace' => 'Posts', 'prefix' => 'reviews'], function () {

  Route::get('/{post}', 'PostController@reviews')->name('public.posts.reviews');
});

