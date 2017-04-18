<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => 'auth.check-role:admin', 'as' => 'admin.'], function () {
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CategoriesController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CategoriesController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CategoriesController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CategoriesController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'CategoriesController@update']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'CategoriesController@destroy']);
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ProductsController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ProductsController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ProductsController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'ProductsController@destroy']);
    });

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'ClientsController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'OrdersController@index']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'OrdersController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'OrdersController@update']);
    });

    Route::group(['prefix' => 'coupons', 'as' => 'coupons.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CouponsController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CouponsController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CouponsController@store']);
        Route::get('/edit/{id}', ['as' => 'edit', 'uses' => 'CouponsController@edit']);
        Route::post('/update/{id}', ['as' => 'update', 'uses' => 'CouponsController@update']);
        Route::get('/destroy/{id}', ['as' => 'destroy', 'uses' => 'CouponsController@destroy']);
    });
});

Route::group(['prefix' => 'customer', 'middleware' => 'auth.check-role:client', 'as' => 'customer.'], function () {
    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CheckoutController@index']);
        Route::get('/create', ['as' => 'create', 'uses' => 'CheckoutController@create']);
        Route::post('/store', ['as' => 'store', 'uses' => 'CheckoutController@store']);
    });
});

Route::group(['middleware' => 'cors'], function () {
    Route::post('oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::group(['prefix' => 'api', 'middleware' => 'oauth', 'as' => 'api.'], function () {
        Route::get('/authenticated', ['as' => 'authenticated', 'uses' => 'Api\UserController@authenticated']);

        Route::group(['prefix' => 'client', 'middleware' => 'oauth.check-role:client', 'as' => 'client.'], function () {
            Route::resource('order', 'Api\Client\ClientCheckoutController', ['except' => ['create', 'edit', 'destroy']]);
        });

        Route::group(['prefix' => 'deliveryman', 'middleware' => 'oauth.check-role:deliveryman', 'as' => 'deliveryman.'], function () {
            Route::resource('order', 'Api\Deliveryman\DeliverymanCheckoutController', ['except' => ['create', 'store', 'edit', 'destroy']]);
            Route::patch('/order/{id}/update-status', ['as' => 'update-status', 'uses' => 'Api\Deliveryman\DeliverymanCheckoutController@updateStatus']);
        });
    });
});
