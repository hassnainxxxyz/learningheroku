<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', 'AuthController@login');
Route::post('/logout', 'AuthController@logout')->middleware('auth:api');

Route::resource("/javascript", 'JavascriptController');



Route::middleware('auth:api')->group(function() {
//   ITEMS
   Route::resource('/items', 'ItemController');


});







//Route::middleware('auth:api')->post('/user', function (Request $request) {
//
//    $user = $request->user();
//
//    return $user;
//});
//





