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

Auth::routes();

Route::group(['prefix' => LaravelLocalization::setLocale(),
             'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {

    Route::get('/', 'MainController@index')->name('main');
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
        Route::resource('/page-content', 'PageContentController');
        Route::resource('/our-team', 'OurTeamController');
        Route::resource('/credentials', 'CredentialsController');
        Route::resource('/customers', 'CustomersController');
        Route::resource('/faqs', 'FaqsController');
        Route::resource('/jobs', 'JobsController');

        // Settings routes
        Route::get('/settings', 'SettingsController@index');
        Route::post('/settings/{id}', 'SettingsController@update')->name('settings.update');

        // Check slug
        Route::get('/request/slug', 'RequestController@slug')->name('request.slug');

        // Ajax requests
        Route::post('/request/remove-banner-image', 'RequestController@removeBannerImage')->name('request.remove.banner.image');
        Route::post('/request/remove-site-logo-image', 'RequestController@removeSiteLogoImage')->name('request.remove.site.logo.image');
        Route::post('/request/remove-site-logo-sm-image', 'RequestController@removeSiteLogoSmImage')->name('request.remove.site.logo.sm.image');
        Route::post('/request/remove-our-team-image', 'RequestController@removeOurTeamImage')->name('request.remove.our.team.image');
        Route::post('/request/remove-credential-image', 'RequestController@removeCredentialImage')->name('request.remove.credential.image');
        Route::post('/request/remove-customers-image', 'RequestController@removeCustomersImage')->name('request.remove.customers.image');
        Route::delete('/request/remove-phone-number', 'RequestController@removePhoneNumber')->name('request.remove.phone.number');
    });

    // Dynamic pages
//    Route::get('/{slug}', ['as' => 'pages.show', 'uses' => 'PagesController@show']);
    Route::get('/services/{slug}', ['as' => 'services.show', 'uses' => 'ServicesController@show']);
    Route::get('/industry/{slug}', ['as' => 'industry.show', 'uses' => 'IndustryController@show']);

    // Default pages routes.
    Route::get('/about-us', 'AboutUsController@index')->name('about-us');
    Route::get('/credentials', 'CredentialsController@index')->name('credentials');
    Route::get('/credentials', 'CredentialsController@index')->name('credentials');
    Route::get('/customers', 'CustomersController@index')->name('customers');
    Route::get('/faqs', 'FaqsController@index')->name('faqs');

});
