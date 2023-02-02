<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::post('add', 'FavoriteController@create');
    Route::post('delete', 'FavoriteController@delete');
    Route::get('get', 'FavoriteController@get');
});
