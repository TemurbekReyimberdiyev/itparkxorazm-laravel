<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/admin/{any?}', function () {
//    return file_get_contents(public_path('admin/index.html'));
//})->where('any', '.*');
//
//Route::group(['prefix' => 'admin'], function () {
//    Voyager::routes();
//});
