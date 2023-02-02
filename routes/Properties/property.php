<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('create', 'PropertyController@create');
    Route::post('update', 'PropertyController@update');
    Route::post('delete', 'PropertyController@delete');
});
Route::get('filter', 'PropertyController@filter');
