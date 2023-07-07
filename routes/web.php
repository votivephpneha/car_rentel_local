<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ScoutController;
use App\Http\Controllers\Scout\ScoutUserController;
use Illuminate\Support\Facades\Mail;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/add_news_action', 'App\Http\Controllers\HomeController@add_news_action');
Route::any('/add_help_action', 'App\Http\Controllers\HomeController@add_help_action');

/* Pages */

Route::any('/page/{pageurl}', 'App\Http\Controllers\HomeController@cms_page');
Route::any('faq', 'App\Http\Controllers\HomeController@faq');
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

        
    });
});


