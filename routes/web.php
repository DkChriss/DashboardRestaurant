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

Auth::routes([
    'register' => false
]);

// check if authenticated
Route::group(['middleware' => ['auth']], function () {
    
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('user', 'UserController');
    Route::get('user.list', 'UserController@list')->name('user.list');
    
    Route::resource('client', 'ClientController');
    Route::get('client.list', 'ClientController@list')->name('client.list');
    
    Route::resource('dish', 'DishController');
    Route::get('dish.list', 'DishController@list')->name('dish.list');
    Route::get('dish.filter', 'DishController@dishFilter')->name('dish.filter');
    
    Route::resource('drink', 'DrinkController');
    Route::get('drink.list', 'DrinkController@list')->name('drink.list');
    Route::get('drink.filter', 'DrinkController@drinkFilter')->name('drink.filter');
    
    Route::resource('combo', 'ComboController');
    Route::get('combo.list', 'ComboController@list')->name('combo.list');
    
    Route::resource('shopping', 'ShoppingController');
    Route::get('shopping.list', 'ShoppingController@list')->name('shopping.list');
    
    Route::resource('order', 'OrderController');
    Route::get('dishes','OrderController@dishes')->name('order.dishes');
    Route::get('drinks', 'OrderController@drinks')->name('order.drinks');
    Route::get('combos', 'OrderController@combos')->name('order.combos');
    
    Route::resource('order-dishes', 'OrderDishController');
    Route::get('order-dishes.list', 'OrderDishController@list')->name('order-dishes.list');
    
    Route::resource('order-drinks', 'OrderDrinkController');
    Route::get('order-drinks.list', 'OrderDrinkController@list')->name('order-drinks.list');
    
    Route::resource('order-combos', 'OrderComboController');
    Route::get('order-combos.list', 'OrderComboController@list')->name('order-combos.list');

});

