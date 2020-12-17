<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'App\Http\Controllers\HomeController@homepage')->name('welcome');

Auth::routes();

Route::get('/profile', 'App\Http\Controllers\HomeController@profile')->name('profile');


Route::group(['prefix' => 'api'], function () {
    Route::apiResource('blog','App\Http\Controllers\BlogsController');
});
