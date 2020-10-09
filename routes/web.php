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

Route::group(['prefix' => LaravelLocalization::setLocale(),
             'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
], function () {

    Auth::routes();

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
        Route::resource('/payment-gateways', 'PaymentGatewaysController');
        Route::resource('/ratings', 'RatingsController');

        Route::delete('/translation-services/rollback', 'TranslationServicesController@rollback')->name('translation.services.rollback');
        Route::get('/translation-services/{id}/duplicate', 'TranslationServicesController@duplicate');
        Route::resource('/translation-services', 'TranslationServicesController');

        // Catalog routes
        Route::delete('/catalog/rollback', 'CatalogController@rollback')->name('catalog.rollback');
        Route::resource('/catalog', 'CatalogController');

        // Product routes
        Route::delete('/product/rollback', 'ProductController@rollback')->name('product.rollback');
        Route::get('/product/{id}', ['as' => 'product.index', 'uses' => 'ProductController@index']);
        Route::get('/product/{id}/create', 'ProductController@create');
        Route::get('/product/{id}/duplicate', 'ProductController@duplicate');
        Route::resource('/product', 'ProductController', ['except' => ['index']]);

        // Job request routes
        Route::get('/job-requests/download/{file}', 'JobRequestsController@download')->name('job-requests.download');
        Route::resource('/job-requests', 'JobRequestsController');

        // Settings routes
        Route::get('/settings', 'SettingsController@index')->name('settings');
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

        Route::post('/request/remove-translation-service-image', 'RequestController@removeTranslationServiceImage')->name('request.remove.translation.service.image');
        Route::post('/request/remove-product-image', 'RequestController@removeProductImage')->name('request.remove.product.image');
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
    Route::get('/get-in-touch', 'GetInTouchController@index')->name('get-in-touch');
    Route::resource('/join-us', 'JoinUsController');
    Route::resource('/help-us-improve', 'HelpUsImproveController');

    // Profile routes
    Route::get('/profile/change-password', 'ProfileController@changePassword')->name('profile.change-password');
    Route::resource('/profile', 'ProfileController');

    // Rent equipment routes
    Route::get('/rent-equipment/search-product', ['uses' => 'RentEquipmentController@getSearch', 'as' => 'search-product']);
    Route::get('/rent-equipment', 'RentEquipmentController@index')->name('rent-equipment');
    Route::post('/rent-equipment/add-wishlist', 'RentEquipmentController@addWishlist')->name('rent-equipment.add-wishlist');
    Route::get('/document-shop', 'DocumentShopController@index')->name('document-shop');
    Route::get('/document-shop/catalog/{id}', 'DocumentShopController@catalog')->name('document-shop.catalog');
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::get('/wishlist/search', ['uses' => 'WishlistController@getSearch','as' => 'search']);

    // Ajax requests
    Route::post('/front-request/remove-user-image', 'FrontRequestController@removeUserImage')->name('front-request.remove.user.image');

});

//Clear route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});

// Clear application cache:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});
