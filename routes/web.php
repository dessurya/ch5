<?php

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

// main
	Route::get('/', 'Main\MainController@beranda')
		->name('main.home');
	Route::get('/about_us', 'Main\MainController@aboutus')
		->name('main.about_us');

	Route::get('/product', 'Main\MainController@product')
		->name('main.product');
	Route::get('/product/calldata', 'Main\MainController@productCallData')
		->name('main.product.call');
	Route::get('/product/{id}', 'Main\MainController@productDetail')
		->name('main.product.detail');

	Route::get('/service', 'Main\MainController@servis')
		->name('main.service');

	Route::get('/projcet-list', 'Main\MainController@projectList')
		->name('main.projectList');

	Route::post('/contact_us', 'Main\MainController@contact')
		->name('main.contact_us');
// main

// new user default
	// Route::get('adduser', function(){
	// 	$confirmation_code = str_random(30).time();
	// 	$user = new App\Models\User;
	// 	$user->name = 'Adam Surya Des';
	// 	$user->email = 'fourline66@gmail.com';
	// 	$user->confirmed = 'Y';
	// 	$user->login_count = 0;
	// 	$user->password = Hash::make('asdasd');
	// 	$user->confirmation_code = $confirmation_code;
	// 	$user->save();

	// 	return redirect()
	// 		->route('loginForm')
	// 		->with('status', 'success to add adam');
	// });
// new user default

// portal admin
	Route::prefix('admin')->group(function(){

	    // login logout
			Route::get('login', 'Auth\LoginController@showLoginForm')
				->name('loginForm');
		    Route::post('login', 'Auth\LoginController@login')
		    	->name('login');
		    Route::post('logout', 'Auth\LoginController@logout')
		    	->name('logout');
	    // login logout

	    // Middleware Auth
	    	Route::middleware(['auth'])->group(function(){

	    		// dashboard
		    		Route::get('dashboard', 'AdminPortal\DashboardController@index')
		    			->name('adpor.dashboard');
	    		// dashboard

		    	// Content Web
		    		Route::prefix('content-web')->group(function(){
		    			
		    			Route::get('{index}', 'AdminPortal\ContentWebController@index')
				    			->name('adpor.ccw.index');

				    	Route::get('{index}/datatables', 'AdminPortal\ContentWebController@datatables')
				    			->name('adpor.ccw.datatables');
				    	Route::get('{index}/aksi', 'AdminPortal\ContentWebController@aksi')
				    			->name('adpor.ccw.aksi');
				    	Route::get('{index}/openform', 'AdminPortal\ContentWebController@openform')
				    			->name('adpor.ccw.openform');
				    	Route::post('{index}/openform', 'AdminPortal\ContentWebController@openformstore')
				    			->name('adpor.ccw.openform.store');
		    		});
		    	// Content Web

	    		// users
		    		Route::get('user', 'AdminPortal\UserController@index')
		    			->name('adpor.user.index');
		    		Route::get('user/reset/{id}', 'AdminPortal\UserController@resetPassword')
		    			->name('adpor.user.resetpassword');
		    		Route::get('user/delete/{id}', 'AdminPortal\UserController@delete')
		    			->name('adpor.user.delete');
		    		Route::get('user/status/{id}', 'AdminPortal\UserController@status')
		    			->name('adpor.user.status');
		    		Route::post('user/store', 'AdminPortal\UserController@add')
		    			->name('adpor.user.store');
		    		Route::post('user/update/me', 'AdminPortal\UserController@update')
		    			->name('adpor.user.update.me');
		    	// users

		    	// message
	    			Route::get('message', 'AdminPortal\DashboardController@message')
		    			->name('adpor.message');
		    	// message
	    	});
	    // Middleware Auth
	});
// portal admin
