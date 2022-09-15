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

Route::group(['namespace' => 'Api'], function () {
    Route::post('auth/register', 'UserController@register');
    Route::post('auth/register-social', 'UserController@registerSocial');
    Route::post('auth/login', 'UserController@login');
    Route::post('auth/login-social', 'UserController@loginSocial');
    Route::post('auth/logout', 'UserController@logout');
    Route::get('auth/reset-password', 'UserController@sendVerifyCode');
    Route::post('auth/reset-password', 'UserController@postForgetPass');

    Route::get('auth/register/send-code', 'UserController@sendRegisterCode');
    Route::post('auth/register/verify-code', 'UserController@checkRegisterCode');

    Route::resource('products', 'ProductController');
    Route::group(['prefix' => 'supplier'], function () {
        Route::get('detail/{id}', 'SupplierController@getDetailSupplier');
    });

    Route::get('static-content', 'ArticleController@getStaticPage');

    Route::group(['middleware' => 'jwtAuth'], function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('info', 'UserController@getUserInfo');
            Route::post('edit', 'UserController@postEditInfo');
            Route::get('notify', 'NotifyController@getListNotify');
            Route::get('notify/read/{id}', 'NotifyController@readNotify');
            Route::post('change-pass', 'UserController@postChangePass');
        });

        Route::group(['prefix' => 'orders'], function () {
            Route::post('rate', 'OrderController@postRateOrder');
            Route::post('upload-image', 'OrderController@uploadImageOrder');
            Route::get('reorder/{code}', 'OrderController@getReorder');
        });

        Route::resource('orders', 'OrderController');

        Route::post('logout', 'UserController@logout');
        Route::get('list-country', 'UserController@getListCountry');
        Route::get('list-city/{id}', 'UserController@getListCity');
        Route::get('list-district/{id}', 'UserController@getListDistrict');

        Route::post('feedback', 'ArticleController@postAddQNA');
    });

    //api for web/app supplier
    Route::group(['prefix' => 'supplier'], function () {
        Route::post('login', 'SupplierController@login');
        Route::get('static-content', 'ArticleController@getStaticPage');
        Route::group(['middleware' => 'jwtAuth'], function () {
            Route::post('register', 'SupplierController@register');
            Route::post('logout', 'SupplierController@logout');
            Route::post('get-info', 'SupplierController@getInfo');
            Route::post('upload-image', 'SupplierController@uploadImage');
            Route::get('count-notify', 'NotifyController@getCountNotifySP');

            Route::group(['middleware' => 'user-supplier'], function () {
                Route::get('list-country', 'UserController@getListCountrySupplier');
                Route::get('list-city', 'UserController@getListCitySupplier');
                Route::get('list-city/{id}', 'UserController@getListCity');
                Route::get('list-district/{id}', 'UserController@getListDistrict');
                Route::get('list-product', 'ProductController@index');

                Route::post('add-product', 'ProductController@postAddProduct');
                Route::post('update-info', 'SupplierController@updateInfo');
                Route::get('list-order', 'SupplierController@getListOrder');
                Route::post('add-order', 'SupplierController@addOrder');
                Route::post('upload-order-image', 'SupplierController@uploadImageOrder');
                Route::get('delete-image/{id}', 'SupplierController@deleteImage');
                Route::post('update-order', 'SupplierController@updateOrder');
                Route::post('edit-info', 'SupplierController@postEditInfo');

                Route::get('list-order-customer', 'SupplierController@getListOrderCustomer');
                Route::get('detail-order-customer', 'SupplierController@getDetailOrderCustomer');
                Route::post('process-order','SupplierController@processOrder');

                Route::post('add-bank-account','SupplierController@addBankAccount');
                Route::post('edit-bank-account','SupplierController@editBankAccount');
                Route::get('list-bank-account','SupplierController@getListBankAccount');
                Route::get('detail-bank-account/{id}','SupplierController@getDetailBankAccount');

                Route::get('revenue', 'SupplierController@getRevenue');
                Route::get('revenue-product', 'SupplierController@getRevenueProduct');
                Route::get('order-statistic', 'SupplierController@getOrderStatistic');
                Route::get('top-order', 'SupplierController@getTopOrder');

                Route::get('notify', 'NotifyController@getListNotifySP');
                Route::get('notify/read/{id}', 'NotifyController@readNotify');
            });
        });

    });
});

