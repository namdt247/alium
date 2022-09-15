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

Route::get('/test', 'Controller@test');

Route::group(['namespace' => 'Frontend'], function(){
    Route::get('/', [
        'as' => 'frontend.home',
        'uses' => 'HomeController@home'
    ]);

    Route::get('login',[
        'as' => 'frontend.login',
        'uses' => 'UserController@getLogin'
    ]);

    Route::post('login',[
        'as' => 'frontend.login',
        'uses' => 'UserController@postLogin'
    ]);

    Route::get('logout',[
        'as' => 'frontend.logout',
        'uses' => 'UserController@getLogout'
    ]);

    Route::post('registersocial',[
        'as' => 'frontend.registersocial',
        'uses' => 'UserController@postRegisterSocial'
    ]);

    Route::post('register',[
        'as' => 'frontend.register',
        'uses' => 'UserController@postRegister'
    ]);

    Route::get('register/verify/{code}',[
        'as' => 'frontend.user.active',
        'uses' => 'UserController@getActive'
    ]);

    Route::get('/redirect/{provideId}',[
        'as' => 'frontend.social.redirect',
        'uses' => 'UserController@redirectSocial'
    ]);
    Route::get('/callback/{provideId}',[
        'as'  => 'frontend.social.callback',
        'uses' => 'UserController@callbackSocial'
    ]);

    Route::post('forget-pass',[
        'as' => 'frontend.forgetPass',
        'uses' => 'UserController@postForgetPass'
    ]);

    Route::get('/forget-pass/send-code/{email}',[
        'as' => 'frontend.forgetPass.sendCode',
        'uses' => 'UserController@getCodeForgetPass'
    ]);

    Route::get('get-rate-supplier/{id}',[
        'as' => 'frontend.supplier.getListRate',
        'uses' => 'SupplierController@getListRate'
    ]);

    Route::group(['prefix' => 'tin-tuc'],function (){
        Route::get('{detail}-{id}',[
            'as' => 'frontend.article.detail',
            'uses' =>'ArticleController@getDetailArticle'
        ])->where(array('id' => '[0-9]+', 'detail' => '[a-zA-Z0-9-]+'));

        Route::get('/',[
            'as' => 'frontend.article.getList',
            'uses' => 'ArticleController@getListArticle'
        ]);


        Route::get('/tu-khoa/{alias}',[
            'as' => 'frontend.article.getTag',
            'uses' => 'ArticleController@getListArticleTag'
        ]);

        Route::get('/{alias}',[
            'as' => 'frontend.article.getListByCate',
            'uses' => 'ArticleController@getListArticle'
        ]);

    });

    Route::group(['prefix' => 'tuyen-dung'],function (){
        Route::get('{detail}-{id}',[
            'as' => 'frontend.recruitment.detail',
            'uses' =>'ArticleController@getDetailRecruitment'
        ])->where(array('id' => '[0-9]+', 'detail' => '[a-zA-Z0-9-]+'));

        Route::get('/',[
            'as' => 'frontend.recruitment.getListRecruitment',
            'uses' => 'ArticleController@getShowListRecruitment'
        ]);


        // Route::get('/tu-khoa/{alias}',[
        //     'as' => 'frontend.article.getTag',
        //     'uses' => 'ArticleController@getListArticleTag'
        // ]);

        // Route::get('/{alias}',[
        //     'as' => 'frontend.article.getListByCate',
        //     'uses' => 'ArticleController@getListArticle'
        // ]);

    });

    Route::group(['prefix' => 'dieu-khoan'],function (){

        Route::get('/{alias}',[
            'as' => 'frontend.policy.getPage',
            'uses' => 'ArticleController@getStaticPage'
        ]);

    });

    Route::group(['prefix' => 'cham-soc-khach-hang'],function (){
        Route::get('hoi-alium',[
            'as' => 'frontend.faq.getAdd',
            'uses' => 'ArticleController@getAddFaq'
        ]);

        Route::post('hoi-alium',[
            'as' => 'frontend.faq.postAdd',
            'uses' => 'ArticleController@postAddFaq'
        ]);

        Route::get('{alias}',[
            'as' => 'frontend.faq.getGuide',
            'uses' => 'ArticleController@getCustomerGuide'
        ]);

    });


    Route::group(['middleware' => 'user-frontend'],function (){

        Route::get('dat-hang',[
            'as' => 'frontend.order.getAdd',
            'uses' => 'OrderController@getAddOrder'
        ]);

        Route::post('dat-hang',[
            'middleware' => 'user',
            'as' => 'frontend.order.postAdd',
            'uses' => 'OrderController@postAddOrder'
        ]);

        Route::group(['prefix' => 'user'],function (){
            Route::post('send-token',[
                'as' => 'frontend.user.postToken',
                'uses' => 'UserController@postSaveToken'
            ]);

            Route::get('list-notify',[
                'as' => 'frontend.notify.getList',
                'uses' => 'UserController@getListNotify'
            ]);

            Route::get('profile',[
                'as' => 'frontend.user.getProfile',
                'uses' => 'UserController@getProfile'
            ]);

            Route::post('profile',[
                'as' => 'frontend.user.postProfile',
                'uses' => 'UserController@postChangeProfile'
            ]);

            Route::get('change-pass',[
                'as' => 'frontend.user.getChangePass',
                'uses' => 'UserController@getChangePass'
            ]);

            Route::post('change-pass',[
                'as' => 'frontend.user.postChangePass',
                'uses' => 'UserController@postChangePass'
            ]);
        });

        Route::group(['prefix'=>'orders'],function (){
            Route::get('list',[
                'as' => 'frontend.order.getList',
                'uses' => 'OrderController@getListOrder'
            ]);
            Route::get('history',[
                'as' => 'frontend.order.getHistory',
                'uses' => 'OrderController@getHistoryOrder'
            ]);

            Route::get('cancel-order/{code}',[
                'as' => 'frontend.order.getCancel',
                'uses' => 'OrderController@getCancelOrder'
            ]);

            Route::post('choose-supplier',[
                'as' => 'frontend.order.postChooseSupplier',
                'uses' => 'OrderController@postChooseSupplier'
            ]);

            Route::get('received/{code}',[
                'as' => 'frontend.order.getReceived',
                'uses' => 'OrderController@getReceivedOrder'
            ]);

            Route::get('reorder/{code}',[
                'as' => 'frontend.order.getReorder',
                'uses' => 'OrderController@getReOrder'
            ]);

            Route::post('rate',[
                'as' => 'frontend.order.postRate',
                'uses' => 'OrderController@postRateOrder'
            ]);

            Route::get('payment/{code}',[
                'as' => 'frontend.order.getPayment',
                'uses' => 'OrderController@getPaymentOrder'
            ]);

            Route::post('payment/{code}',[
                'as' => 'frontend.order.postPayment',
                'uses' => 'OrderController@postPaymentOrder'
            ]);

            Route::get('{detail}',[
                'as' => 'frontend.order.getDetail',
                'uses' => 'OrderController@getDetailOrder'
            ]);
        });
    });
});

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('register/verify/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('tin-tuc/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('tin-tuc/tu-khoa/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('dieu-khoan/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('cham-soc-khach-hang/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('user/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('orders/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('orders/received/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('orders/reorder/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('orders/payment/locale/{locale}', function ($locale) {
    Session::put('locale',$locale);
    return redirect()->back();
});

Route::get('/export_excel', 'ExportExcelController@index');
Route::get('/export_excel/excel', 'ExportExcelController@excel')->name('export_excel.excel');
