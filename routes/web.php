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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin routes
Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {

    // Admin authentication routes
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@index')->name('login');
        Route::post('/login', 'LoginController@login')->name('login');
        Route::post('/logout', 'LoginController@logout')->name('logout');
    });

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/page', 'PageController');
    Route::resource('/banner', 'BannerController');
    Route::resource('/seo', 'SeoController');

    // Check slug
    Route::get('/request/slug', 'RequestController@slug')->name('request.slug');
    Route::post('/request/remove-banner-image', 'RequestController@removeBannerImage')->name('request.remove.banner.image');
});

Route::get('/{slug}', ['as' => 'pages.show', 'uses' => 'PagesController@show']);

Route::get('/blog', ['as' => 'pages.show', 'uses' => 'PagesController@blog']);
