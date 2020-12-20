<?php

use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

<<<<<<< HEAD
// Route::get('/', 'App\Http\Controllers\BlogsController@index')->name('welcome');
Route::resource('','App\Http\Controllers\BlogsController');
=======
Route::get('/', 'App\Http\Controllers\HomeController@homepage')->name('welcome');
>>>>>>> e0461ba0fff1882e1b73b555834562abeffed271

Auth::routes();

Route::get('/profile', 'App\Http\Controllers\HomeController@profile')->name('profile');


Route::group(['prefix' => 'api'], function () {
    Route::apiResource('blog','App\Http\Controllers\BlogsController');
});
