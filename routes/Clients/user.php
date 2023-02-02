<?php





Route::get('profile', 'UserController@getUserData')->middleware('auth:api');
