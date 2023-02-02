<?php
use Illuminate\Support\Facades\Route;


Route::post('signUp','AuthController@signUp');
Route::post('signIn','AuthController@signIn');


Route::middleware(['auth:api'])->group(function () {
    Route::get('logout', 'AuthController@logout');
});
