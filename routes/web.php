<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ScoutController;
use App\Http\Controllers\Scout\ScoutUserController;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LangController;

Route::get('/clear', function () {
    $exitCode = Artisan::call('view:clear', []);   
          return '<h1>cache cleared</h1>';
    });
    Route::get('/config-cache', function() {
        $exitCode = Artisan::call('config:cache');
        $exitCode = Artisan::call('config:clear');
          return '<h1>config cache cleared</h1>';
    
    });
    Route::get('/view-clear', function() {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });


Route::any("/test",function ()
{	 	
	try {
		Mail::send("email.test",[],function($message){

			// $message->from(config("app.webmail"), config("app.mailname"));
			// $message->from('info@votivelaravel.in', 'votivelaravel.in');
			$message->from('roadNstays@votivelaravel.in', 'votivelaravel.in');
	
		   $message->subject("Test Email");
	
		   $message->to("votivephp.rahulraj@gmail.com");
	
		});
	
		return "Success";
	} catch (Exception $ex) {
		// Debug via $ex->getMessage();
		return "We've got errors!";
	}
});



Route::fallback(function () {
    return view("errors/404");
});


Auth::routes();

Route::get('lang/home', [LangController::class, 'index']);
Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::get('lang/{lang}', [App\Http\Controllers\LocalizationContoller::class, 'swithchLang'])->name('swithchLang');
// Route::get('/{locale?}', function ($locale = null) {
//     if (isset($locale) && in_array($locale, config('app.available_locales'))) {
//         app()->setLocale($locale);
//     }
    
//     return view('welcome');
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/car_list', [App\Http\Controllers\HomeController::class, 'car_list'])->name('car_list');
Route::get('/get_car_list', [App\Http\Controllers\HomeController::class, 'get_cars'])->name('get_cars');
Route::get('/get_address', [App\Http\Controllers\HomeController::class, 'get_address'])->name('get_address');
Route::get('/get_dropoff_address', [App\Http\Controllers\HomeController::class, 'get_dropoff_address'])->name('get_dropoff_address');
Route::get('/car_list_category', [App\Http\Controllers\HomeController::class, 'car_list_category'])->name('get_cars');
Route::get('/booking/{car_id}', [App\Http\Controllers\HomeController::class, 'booking'])->name('booking');
Route::post('/submit_booking', [App\Http\Controllers\HomeController::class, 'submit_booking'])->name('submit_booking');
Route::get('/payment/{car_id}', [App\Http\Controllers\HomeController::class, 'payment_page'])->name('payment_page');
Route::post('/manage_booking', [App\Http\Controllers\HomeController::class, 'manage_booking'])->name('manage_booking');
Route::post('/submit_payment', [App\Http\Controllers\HomeController::class, 'submit_payment'])->name('submit_payment');
Route::get('/thankyou', [App\Http\Controllers\HomeController::class, 'thankyou'])->name('thankyou');
Route::get('/baseForm', [App\Http\Controllers\HomeController::class, 'baseForm'])->name('baseForm');

Route::post('/updateProfile', 'App\Http\Controllers\HomeController@updateProfile');
Route::post('/updateProfileImage', 'App\Http\Controllers\HomeController@updateProImg'); 

Route::post('/user/loginPost', 'App\Http\Controllers\HomeController@postLogin'); 
Route::post('/user/signup', 'App\Http\Controllers\HomeController@signup'); 
Route::post('/servicepro/loginPost', 'App\Http\Controllers\HomeController@serviceProPostLogin');
Route::post('/servicepro/signup', 'App\Http\Controllers\HomeController@vendorSignup');  

Route::post('forgotPassword_action','App\Http\Controllers\HomeController@forgotPassword_action');

Route::any('/add_news_action', 'App\Http\Controllers\HomeController@add_news_action');
Route::any('/add_help_action', 'App\Http\Controllers\HomeController@add_help_action');

/* Pages */

Route::any('/page/{pageurl}', 'App\Http\Controllers\HomeController@cms_page');

// user route start here
Route::group(['middleware' => 'App\Http\Middleware\UserMiddleware'], function () {
    Route::get('user/profile','App\Http\Controllers\HomeController@userProfile')->name('user.profile');
    Route::any('user/changePassword', 'App\Http\Controllers\HomeController@change_password');
    // Route::any('user/logout', 'App\Http\Controllers\HomeController@userLogout');	
    Route::any('user/logout', 'App\Http\Controllers\HomeController@userLogout')->name('user.logout');
});	

// vendor route start here
Route::group(['middleware' => 'App\Http\Middleware\VendorMiddleware'], function () {
    Route::get('servicepro/dashboard','App\Http\Controllers\HomeController@serviceProDashboard')->name('servicepro.dashboard');
    Route::any('servicepro/profile', 'App\Http\Controllers\HomeController@serviceProProfile');
    // Route::any('servicepro/changePassword', 'App\Http\Controllers\HomeController@change_password');
    Route::any('servicepro/logout', 'App\Http\Controllers\HomeController@serviceProLogout')->name('servicepro.logout');	
});	


Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('/login','App\Http\Controllers\AdminController@login')->name('admin.login');	
        Route::get('/','App\Http\Controllers\AdminController@login')->name('admin.login');	
        Route::post('/loginPost', 'App\Http\Controllers\AdminController@authenticate'); 
    });
    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/dashboard','App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');
        Route::any('/profile', 'App\Http\Controllers\AdminController@profile');
        Route::any('/changePassword', 'App\Http\Controllers\AdminController@change_password');
        Route::any('/logout', 'App\Http\Controllers\AdminController@logout')->name('admin.logout');	

        Route::get('/customer_management', 'App\Http\Controllers\CustomerController@index');
        Route::get('/add_customer', 'App\Http\Controllers\CustomerController@add_customer');
        Route::any('/add_customer_action', 'App\Http\Controllers\CustomerController@add_customer_action');
        Route::get('/edit_customer/{id}', 'App\Http\Controllers\CustomerController@edit_customer');
        Route::any('/customer_update', 'App\Http\Controllers\CustomerController@customer_update');
        Route::get('/change_user_status', 'App\Http\Controllers\CustomerController@change_user_status');
        Route::any('/deletecustomer', 'App\Http\Controllers\CustomerController@deletecustomer');

        Route::get('/business_management', 'App\Http\Controllers\CustomerController@business_management');
        Route::get('/business_list', 'App\Http\Controllers\CustomerController@business_management');
        Route::get('/business_management/{status}', 'App\Http\Controllers\CustomerController@business_management');
        Route::get('/business_management/{status}/{from_date}/{to_date}', 'App\Http\Controllers\CustomerController@business_management');
        Route::get('/business_management/{from_date}/{to_date}', 'App\Http\Controllers\CustomerController@business_management');
        Route::get('/add_business_user', 'App\Http\Controllers\CustomerController@add_business_user');
        Route::any('/add_business_action', 'App\Http\Controllers\CustomerController@add_business_action');
        Route::get('/edit_business/{id}', 'App\Http\Controllers\CustomerController@edit_business');
        Route::any('/business_update', 'App\Http\Controllers\CustomerController@business_update');
        Route::get('/change_business_status', 'App\Http\Controllers\CustomerController@change_business_status');
        Route::any('/deletebusiness', 'App\Http\Controllers\CustomerController@deletebusiness');


        Route::get('/content_management', 'App\Http\Controllers\AdminController@cms_page');
        Route::get('/add_page', 'App\Http\Controllers\AdminController@add_page');
        Route::any('/add_page_action', 'App\Http\Controllers\AdminController@add_page_action');
        Route::get('/edit_page/{id}', 'App\Http\Controllers\AdminController@edit_page');
        Route::any('/page_update', 'App\Http\Controllers\AdminController@page_update');
        Route::get('/change_page_status', 'App\Http\Controllers\AdminController@change_page_status');
        Route::any('/deletepage', 'App\Http\Controllers\AdminController@deletepage');

        Route::get('/home_management', 'App\Http\Controllers\AdminController@home_management');
        Route::any('/update_home', 'App\Http\Controllers\AdminController@update_home');
		
		Route::get('/landing_management', 'App\Http\Controllers\AdminController@landing_management');
        Route::any('/update_landing', 'App\Http\Controllers\AdminController@update_landing');

        Route::get('/our_mission', 'App\Http\Controllers\AdminController@our_mission');
        Route::any('/mission_update', 'App\Http\Controllers\AdminController@mission_update');

        Route::get('/our_plan', 'App\Http\Controllers\AdminController@our_plan');
        Route::any('/plan_update', 'App\Http\Controllers\AdminController@plan_update');

        Route::get('/our_team', 'App\Http\Controllers\AdminController@our_team');
        Route::any('/team_update', 'App\Http\Controllers\AdminController@team_update');

        Route::get('/team', 'App\Http\Controllers\AdminController@team');
        Route::get('/add_team', 'App\Http\Controllers\AdminController@add_team');
        Route::any('/add_team_action', 'App\Http\Controllers\AdminController@add_team_action');
        Route::get('/edit_team/{id}', 'App\Http\Controllers\AdminController@edit_team');
        Route::any('/team_updates', 'App\Http\Controllers\AdminController@team_updates');
        Route::get('/change_team_status', 'App\Http\Controllers\AdminController@change_team_status');
        Route::any('/deleteteam', 'App\Http\Controllers\AdminController@deleteteam');

        Route::get('/faqs', 'App\Http\Controllers\AdminController@faqs');
        Route::get('/add_faq', 'App\Http\Controllers\AdminController@add_faq');
        Route::any('/add_faq_action', 'App\Http\Controllers\AdminController@add_faq_action');
        Route::get('/edit_faq/{id}', 'App\Http\Controllers\AdminController@edit_faq');
        Route::any('/faq_update', 'App\Http\Controllers\AdminController@faq_update');
        Route::get('/change_faq_status', 'App\Http\Controllers\AdminController@change_faq_status');
        Route::any('/deletefaq', 'App\Http\Controllers\AdminController@deletefaq');

        Route::get('/newsletter', 'App\Http\Controllers\AdminController@newsletter');
        Route::get('/edit_newsletter/{id}', 'App\Http\Controllers\AdminController@edit_newsletter');
        Route::any('/newsletter_update', 'App\Http\Controllers\AdminController@newsletter_update');
        Route::get('/newsletter_status', 'App\Http\Controllers\AdminController@newsletter_status');
        Route::any('/delete_newsletter', 'App\Http\Controllers\AdminController@delete_newsletter');

        Route::get('/help_notification', 'App\Http\Controllers\AdminController@help_notification');
        Route::get('/edit_help/{id}', 'App\Http\Controllers\AdminController@edit_help');
        Route::any('/help_notification_update', 'App\Http\Controllers\AdminController@help_update');
        Route::get('/change_help_status', 'App\Http\Controllers\AdminController@help_status');
        Route::any('/delete_help', 'App\Http\Controllers\AdminController@delete_help');

        Route::get('/scoutList', 'App\Http\Controllers\ScoutController@scout_list');
        Route::get('/addScout', 'App\Http\Controllers\ScoutController@add_scout');
        Route::any('/submitScout', 'App\Http\Controllers\ScoutController@submit_scout');
        Route::get('/editScout/{id}', 'App\Http\Controllers\ScoutController@edit_scout');
        Route::any('/updateScout', 'App\Http\Controllers\ScoutController@update_scout');
        Route::get('/changeScoutStatus', 'App\Http\Controllers\ScoutController@change_scout_status');
        Route::any('/deleteScout', 'App\Http\Controllers\ScoutController@delete_scout');

        Route::get('/serviceProviderList', 'App\Http\Controllers\ServiceproviderController@service_provider_list');
        Route::get('/addServiceProvider', 'App\Http\Controllers\ServiceproviderController@add_serv_provider');
        Route::any('/submitServiceProvider', 'App\Http\Controllers\ServiceproviderController@submit_serv_provider');
        Route::get('/editServiceProvider/{id}', 'App\Http\Controllers\ServiceproviderController@edit_serv_provider');
        Route::any('/updateServiceProvider', 'App\Http\Controllers\ServiceproviderController@update_serv_provider');
        Route::get('/change_serv_provider_status', 'App\Http\Controllers\ServiceproviderController@change_serv_provider_status');
        Route::any('/deleteServiceProvider', 'App\Http\Controllers\ServiceproviderController@delete_serv_provider');

        Route::get('/hotelList', 'App\Http\Controllers\Admin\HotelController@hotel_list');
        Route::get('/addHotel', 'App\Http\Controllers\Admin\HotelController@add_hotel');
        Route::any('/submitHotel', 'App\Http\Controllers\Admin\HotelController@submit_hotel');
        Route::any('/submitHotelPolicy', 'App\Http\Controllers\Admin\HotelController@submit_hotel_policy');
        Route::any('/submitHotelFacilityService', 'App\Http\Controllers\Admin\HotelController@submit_hotel_facility_service');
        Route::get('/editHotel/{id}', 'App\Http\Controllers\Admin\HotelController@edit_hotel');
        Route::any('/updateHotel', 'App\Http\Controllers\Admin\HotelController@update_hotel');
        Route::get('/changeHotelStatus', 'App\Http\Controllers\Admin\HotelController@change_hotel_status');
        Route::any('/deleteHotel', 'App\Http\Controllers\Admin\HotelController@delete_hotel');

        Route::get('/hotelAndStays_list', 'App\Http\Controllers\Admin\HotelnStaysController@hotelAndStays_list');
        Route::get('/addHotelAndStays', 'App\Http\Controllers\Admin\HotelnStaysController@addHotelAndStays');
        Route::any('/submitHotelAndStays', 'App\Http\Controllers\Admin\HotelnStaysController@submitHotelAndStays');
        Route::get('/editHotelAndStays/{id}', 'App\Http\Controllers\Admin\HotelnStaysController@editHotelAndStays');
        Route::any('/updateHotelAndStays', 'App\Http\Controllers\Admin\HotelnStaysController@updateHotelAndStays');
        Route::get('/changeHotelAndStaysStatus', 'App\Http\Controllers\Admin\HotelnStaysController@changeHotelAndStaysStatus');
        Route::any('/deleteHotelAndStays', 'App\Http\Controllers\Admin\HotelnStaysController@deleteHotelAndStays');

        Route::get('/hotelAmenity_list', 'App\Http\Controllers\Admin\HotelAmenityController@hotelAmenity_list');
        Route::get('/addHotelAmenity', 'App\Http\Controllers\Admin\HotelAmenityController@addHotelAmenity');
        Route::any('/submitHotelAmenity', 'App\Http\Controllers\Admin\HotelAmenityController@submitHotelAmenity');
        Route::get('/editHotelAmenity/{id}', 'App\Http\Controllers\Admin\HotelAmenityController@editHotelAmenity');
        Route::any('/updateHotelAmenity', 'App\Http\Controllers\Admin\HotelAmenityController@updateHotelAmenity');
        Route::get('/changeHotelAmenityStatus', 'App\Http\Controllers\Admin\HotelAmenityController@changeHotelAmenityStatus');
        Route::any('/deleteHotelAmenity', 'App\Http\Controllers\Admin\HotelAmenityController@deleteHotelAmenity');

        Route::get('/hotelService_list', 'App\Http\Controllers\Admin\HotelServiceController@hotelService_list');
        Route::get('/addHotelService', 'App\Http\Controllers\Admin\HotelServiceController@addHotelService');
        Route::any('/submitHotelService', 'App\Http\Controllers\Admin\HotelServiceController@submitHotelService');
        Route::get('/editHotelService/{id}', 'App\Http\Controllers\Admin\HotelServiceController@editHotelService');
        Route::any('/updateHotelService', 'App\Http\Controllers\Admin\HotelServiceController@updateHotelService');
        Route::get('/changeHotelServiceStatus', 'App\Http\Controllers\Admin\HotelServiceController@changeHotelServiceStatus');
        Route::any('/deleteHotelService', 'App\Http\Controllers\Admin\HotelServiceController@deleteHotelService');

        Route::get('/hotelRoomType_list', 'App\Http\Controllers\Admin\HotelRoomtypeController@hotelRoomType_list');
        Route::get('/addHotelRoomType', 'App\Http\Controllers\Admin\HotelRoomtypeController@addHotelRoomType');
        Route::any('/submitHotelRoomType', 'App\Http\Controllers\Admin\HotelRoomtypeController@submitHotelRoomType');
        Route::get('/editHotelRoomType/{id}', 'App\Http\Controllers\Admin\HotelRoomtypeController@editHotelRoomType');
        Route::any('/updateHotelRoomType', 'App\Http\Controllers\Admin\HotelRoomtypeController@updateHotelRoomType');
        Route::get('/changeHotelRoomTypeStatus', 'App\Http\Controllers\Admin\HotelRoomtypeController@changeHotelRoomTypeStatus');
        Route::any('/deleteHotelRoomType', 'App\Http\Controllers\Admin\HotelRoomtypeController@deleteHotelRoomType');

        Route::get('/hotelSpaceType_list', 'App\Http\Controllers\Admin\HotelSpacetypeController@hotelSpaceType_list');
        Route::get('/addHotelSpacetype', 'App\Http\Controllers\Admin\HotelSpacetypeController@addHotelSpacetype');
        Route::any('/submitHotelSpacetype', 'App\Http\Controllers\Admin\HotelSpacetypeController@submitHotelSpacetype');
        Route::get('/editHotelSpacetype/{id}', 'App\Http\Controllers\Admin\HotelSpacetypeController@editHotelSpacetype');
        Route::any('/updateHotelSpacetype', 'App\Http\Controllers\Admin\HotelSpacetypeController@updateHotelSpacetype');
        Route::get('/changeHotelSpacetypeStatus', 'App\Http\Controllers\Admin\HotelSpacetypeController@changeHotelSpacetypeStatus');
        Route::any('/deleteHotelSpacetype', 'App\Http\Controllers\Admin\HotelSpacetypeController@deleteHotelSpacetype');
        Route::get('/booking_management', [AdminController::class, 'booking_management'])->name('booking_management');
        Route::get('/booking_list', [AdminController::class, 'booking_management'])->name('booking_management');
        Route::get('/booking_management/{status}', [AdminController::class, 'booking_management'])->name('booking_management');
        Route::post('/assign_ride', [AdminController::class, 'assign_ride'])->name('assign_ride');
        Route::post('/change_booking_status', [AdminController::class, 'change_booking_status'])->name('change_booking_status');
        Route::get('/view_booking/{id}', [AdminController::class, 'view_booking'])->name('view_booking');
        Route::get('/add_cars', [AdminController::class, 'add_cars'])->name('add_cars');
        Route::post('/submit_cars', [AdminController::class, 'submit_cars'])->name('submit_cars');
        Route::get('/car_management', [AdminController::class, 'car_management'])->name('car_management');
        Route::get('/change_car_status', [AdminController::class, 'change_car_status'])->name('change_car_status');
        Route::get('/edit_cars/{car_id}', [AdminController::class, 'edit_cars'])->name('edit_cars');
        Route::post('/update_cars', [AdminController::class, 'update_cars'])->name('update_cars');
        Route::any('/delete_car', 'App\Http\Controllers\AdminController@delete_car');
        Route::get('/language_management', [AdminController::class, 'language_management'])->name('language_management');
        Route::get('/add_language', [AdminController::class, 'add_language'])->name('add_language');
        Route::post('/submit_languages', [AdminController::class, 'submit_languages'])->name('submit_languages');
        Route::get('/change_language_status', [AdminController::class, 'change_language_status'])->name('change_language_status');
        Route::get('/edit_language/{language_id}', [AdminController::class, 'edit_languages'])->name('add_language');
        Route::post('/update_languages', [AdminController::class, 'update_languages'])->name('update_languages');
        Route::any('/delete_language', [AdminController::class, 'delete_languages'])->name('delete_language');
        Route::get('/add_logo', [AdminController::class, 'add_logos'])->name('add_logo');
        Route::post('/submit_logos', [AdminController::class, 'submit_logos'])->name('add_logo');
        Route::get('/show_logos', [AdminController::class, 'show_logos'])->name('show_logos');
        Route::get('/change_logo_status', [AdminController::class, 'change_logo_status'])->name('change_logo_status');
        Route::get('/edit_logos/{logo_id}', [AdminController::class, 'edit_logos'])->name('edit_logos');
        Route::post('/update_logos', [AdminController::class, 'update_logos'])->name('update_logos');
        Route::any('/delete_logo', [AdminController::class, 'delete_logos'])->name('delete_logo');
        Route::get('/add_categories', [AdminController::class, 'add_categories'])->name('add_categories');
        Route::post('/submit_category', [AdminController::class, 'submit_category'])->name('submit_category');
        Route::get('/show_category', [AdminController::class, 'show_category'])->name('show_category');
        Route::get('/change_category_status', [AdminController::class, 'change_category_status'])->name('change_category_status');
        Route::get('/edit_category/{cat_id}', [AdminController::class, 'edit_category'])->name('edit_category');
        Route::post('/update_category', [AdminController::class, 'update_category'])->name('update_category');
        Route::any('/delete_category', [AdminController::class, 'delete_category'])->name('delete_category');
        Route::get('/translation_management', [AdminController::class, 'translation_management'])->name('translation_management');
        Route::post('/update_translations', [AdminController::class, 'update_translations'])->name('update_translations');
        Route::post('/update_translationsTwo', [AdminController::class, 'update_translationsTwo'])->name('update_translationsTwo');
        Route::post('/update_car_translations', [AdminController::class, 'update_car_translations'])->name('update_car_translations');
        Route::get('/payment_transaction', [AdminController::class, 'payment_transaction'])->name('payment_transaction');
        
        Route::get('/payment_list', [AdminController::class, 'payment_transaction'])->name('payment_transaction');
        Route::get('/payment_transaction/{status}', [AdminController::class, 'payment_transaction'])->name('payment_transaction');
        Route::get('/payment_transaction/{status}/{from_date}/{to_date}', 'App\Http\Controllers\AdminController@payment_transaction');
        Route::get('/payment_transaction/{from_date}/{to_date}', 'App\Http\Controllers\AdminController@payment_transaction');
        Route::get('/change_payment_status', [AdminController::class, 'change_payment_status'])->name('change_payment_status');
        Route::get('/search_date_filter', [AdminController::class, 'search_date_filter'])->name('search_date');
    });
});


Route::group(['prefix' => 'scout'], function(){
    Route::group(['middleware' => 'scout.guest'], function(){ 
        Route::get('/login', [ScoutUserController::class, 'login'])->name('scout.login');	
        Route::post('/loginPost', [ScoutUserController::class, 'postLogin']);	
    });
    Route::group(['middleware' => 'scout.auth'], function(){
        Route::get('/dashboard','App\Http\Controllers\Scout\ScoutUserController@dashboard')->name('scout.dashboard');
        Route::any('/profile', 'App\Http\Controllers\Scout\ScoutUserController@profile');
        Route::any('/changePassword', 'App\Http\Controllers\Scout\ScoutUserController@change_password');
        Route::any('/logout', 'App\Http\Controllers\Scout\ScoutUserController@scoutLogout')->name('scout.logout');	
    });
});

