                                                                                                                                                          <?php

/* ['
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Admin Prefix
*/

Route::prefix('admin')->group(function(){

	Route::middleware('auth:admin')->group(function(){

		// Dashboard

		Route::get('/','DashboardController@index');

		// Product

		Route::resource('/products','ProductController');


		Route::resource('/tags','TagsController');

		// Orders

		Route::resource('/orders','OrderController');
		Route::get('/confirm/{id}','OrderController@confirm')->name('order.confirm');
		Route::get('/pending/{id}','OrderController@pending')->name('order.pending');

		// Users

		Route::resource('/users','UsersController');
		Route::get('/logout','AdminUserController@logout');

	});

	// Admin Login
	Route::get('/login', 'AdminUserController@index')->name('login');
	Route::post('/login', 'AdminUserController@store');

});


//Front
Route::get('/','Front\HomeController@index');
Route::get('/search','Front\HomeController@search');
Route::get('/sort','Front\HomeController@sortby');

//registeration
Route::get('/user/register','Front\RegisterationController@index');
Route::post('/user/register','Front\RegisterationController@store');

//Login

Route::get('/user/login','Front\SessionController@index');
Route::post('/user/login','Front\SessionController@store');

//Logout
Route::get('/user/logout','Front\SessionController@logout');
// User Profile
Route::get('/user/profile','Front\UserProfileController@index');
Route::get('/user/order/{id}','Front\UserProfileController@show')->name('user.show');

//Cart
Route::get('/cart','Front\CartController@index');
Route::post('/cart','Front\CartController@store');
Route::patch('/cart/update/{product}','Front\CartController@update');
Route::delete('/cart/remove/{product}','Front\CartController@destroy');
Route::post('/cart/saveLater/{product}','Front\CartController@SaveLater');

// Save To Later

Route::delete('/saveLater/destroy/{product}','Front\SaveLaterController@destroy')->name('SaveLater.Destroy');
Route::post('/cart/moveToCart/{product}','Front\SaveLaterController@MoveToCart')->name('MoveTo');

// CheckOut

Route::get('/checkout','Front\CheckoutController@index');
Route::post('/checkout','Front\CheckoutController@store')->name('checkout');


Route::get('empty',function(){
	return Cart::instance('default')->destroy();
});






