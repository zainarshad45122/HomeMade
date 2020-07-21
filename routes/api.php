<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()], 200);
});
Route::post('login', 'PassportController@login');
Route::post('register', 'PassportController@register');



Route::middleware('auth:api')->group(function () {
    Route::post('/chef/register', 'ChefController@store');
    Route::get('/user/data','DetailsController@userData');
    Route::post('/chef/report','ReportChefController@store');   
});

Route::middleware(['auth:api','role'])->group(function () {
    Route::put('/chef/update', 'ChefController@update');
    Route::post('/chef/update/image', 'ChefController@updateImage');
    Route::get('/chef', 'ChefController@show');
    Route::post('/chef/cuisine','ChefController@getChefByCuisine');
    Route::get('/chef/cuisine/{chef_id}','ChefController@getChefByCuisine1');
    Route::post('/chefreview','ChefReviewController@store');
    Route::get('/chefreviews','ChefReviewController@show');
    Route::get('/chefdetail','DetailsController@chefdetail');

    Route::post('/dish','DishesController@store');
    Route::get('/dishes','DishesController@show');
    Route::put('/dish/update','DishesController@update');
    Route::post('/dish/update/image', 'DishesController@updateImage');
    Route::Delete('/dish/delete/{id}', 'DishesController@dishdelete');
    Route::get('/dish/{id}','DishesController@getdish');
    Route::post('/dish/cuisine','DishesController@getDishByCuisine');
    Route::get('/dish/cuisine/{cuisine}','DishesController@getDishByCuisine1');
    Route::post('/dish/price','DishesController@priceFilter');
    Route::get('/dishdetail','DetailsController@dishdetail');

    Route::post('/review','ReviewController@store');
    Route::get('/reviews','ReviewController@show');
    Route::get('/data','DetailsController@show');
    Route::post('/order','OrderController@store');
    Route::get('/orders','OrderController@show');
    Route::post('/cuisineprice','DishesController@cuisineprice');

    Route::post('/favouritedish','DishesController@favDishStore');
    Route::get('/favouritedishes','DishesController@favDishShow');
    Route::delete('/favouritedish/delete','DishesController@favDishDelete');
   
});

