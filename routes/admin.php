<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Admin',],function(){
    Route::get('admin-login',['as' => 'admin.login', 'uses' => 'UserController@getLogin']);

    Route::post('admin-login',['as' => 'admin.login', 'uses' => 'UserController@postLogin']);

    Route::get('admin-logout',['as' => 'admin.logout', 'uses' => 'UserController@getLogout']);

    Route::post('product/uploader-order', 'OrderController@uploadImageOrder');

    Route::get('product/delete-image-order/{id}','OrderController@getDeleteImageOrder');

    Route::get('get-city/{id?}',[
        'as' => 'admin.getCity',
        'uses' => 'AdminController@getListCity'
    ]);

    Route::get('get-district/{id?}',[
        'as' => 'admin.getDistrict',
        'uses' => 'AdminController@getListDistrict'
    ]);

    Route::post('product/uploader', 'ProductController@uploadImageProduct');

    Route::get('product/delete-image/{id}','ProductController@deleteImageProduct');
});

Route::group(['prefix' => 'admin','namespace' => 'Admin',
    'middleware' => ['user','role:admin|super-admin|moderator']],function(){
    Route::get('/',[
        'as' => 'admin.dashboard',
        'uses' => 'AdminController@dashboard'
    ]);

    Route::post('/uploader', 'ArticleController@postUpload');

    #region Admin Product
    Route::group(['prefix' => 'product'],function(){
        Route::group([],function () {
            Route::get('list-product', [
                'as' => 'admin.product.list',
                'uses' => 'ProductController@getListProduct'
            ]);

            Route::get('list-product-data', [
                'as' => 'admin.product.listData',
                'uses' => 'ProductController@getListProductData'
            ]);

            Route::get('list-product-search', [
                'as' => 'admin.product.getSearchData',
                'uses' => 'ProductController@getListProductSearch'
            ]);

            Route::get('add-product', [
                'as' => 'admin.product.getAdd',
                'uses' => 'ProductController@getAddProduct'
            ]);

            Route::post('add-product', [
                'as' => 'admin.product.postAdd',
                'uses' => 'ProductController@postAddProduct'
            ]);

            Route::get('delete-product/{id}', [
                'as' => 'admin.product.delete',
                'uses' => 'ProductController@getDeleteProduct'
            ]);

            Route::get('edit-product/{id}', [
                'as' => 'admin.product.getEdit',
                'uses' => 'ProductController@getEditProduct'
            ]);

            Route::post('edit-product/{id}', [
                'as' => 'admin.product.postEdit',
                'uses' => 'ProductController@postEditProduct'
            ]);

            Route::post('order/update-note',[
                'as' => 'admin.product.updateNote',
                'uses' => 'OrderController@postUpdateNote'
            ]);
        });

        #region Order
        Route::group(['middleware' => 'permission:sale|sale manager'],function (){
            Route::get('add-order',[
                'as' => 'admin.order.getAdd',
                'uses' => 'OrderController@getAddOrder'
            ]);
            Route::post('add-order',[
                'as' => 'admin.order.postAdd',
                'uses' => 'OrderController@postAddOrder'
            ]);
        });

        Route::group(['middleware' => 'permission:supplier|sale|sale manager'],function (){
            Route::get('cancel-order/{id}',[
                'as' => 'admin.order.getCancel',
                'uses' => 'OrderController@getCancelOrder'
            ]);

            Route::post('cancel-order/{id}',[
                'as' => 'admin.order.postCancel',
                'uses' => 'OrderController@postCancelOrder'
            ]);

            Route::get('delete-order-image/{id}',[
                'as' => 'admin.order.getDeleteImage',
                'uses' => 'OrderController@getDeleteImageOrder'
            ]);
        });
        Route::group(['middleware' => 'permission:sale manager'],function (){

            Route::get('list-register-user',[
                'as' => 'admin.user.getListUserSaleManager',
                'uses' => 'UserController@getListUserRegisterSaleManager'
            ]);

            Route::get('assignee-sale/{id}',[
                'as' => 'admin.user.getAssigneeSale',
                'uses' => 'UserController@getAssigneeSale'
            ]);

            Route::post('assignee-sale/{id}',[
                'as' => 'admin.user.postAssigneeSale',
                'uses' => 'UserController@postAssigneeSale'
            ]);

            Route::get('list-order',[
                'as' => 'admin.order.getList',
                'uses' => 'OrderController@getListOrder'
            ]);

            Route::get('list-order-data',[
                'middleware' => ['permission:sale manager'],
                'as' => 'admin.order.getListData',
                'uses' => 'OrderController@getListOrderData'
            ]);
            Route::get('delete-order/{id}',[
                'as' => 'admin.order.getDelete',
                'uses' => 'OrderController@getDeleteOrder'
            ]);
            Route::get('edit-order/{id}',[
                'as' => 'admin.order.getEdit',
                'uses' => 'OrderController@getEditOrder'
            ]);
            Route::post('edit-order/{id}',[
                'as' => 'admin.order.postEdit',
                'uses' => 'OrderController@postEditOrder'
            ]);

            Route::get('search-order',[
                'as' => 'admin.order.searchOrder',
                'uses' => 'OrderController@getSearchOrder'
            ]);

            Route::get('change-status-order/{id}',[
                'as' => 'admin.order.changeStatus',
                'uses' => 'OrderController@getChangeStatus'
            ]);

            Route::post('change-status-order/{id}',[
                'as' => 'admin.order.changeStatus',
                'uses' => 'OrderController@postChangeStatus'
            ]);

            Route::get('assign-order/{id}',[
                'as' => 'admin.order.getAssign',
                'uses' => 'OrderController@getAssigneeOrder'
            ]);

            Route::post('assign-order/{id}',[
                'as' => 'admin.order.postAssign',
                'uses' => 'OrderController@postAssigneeOrder'
            ]);

            Route::get('assign-supplier/{id}',[
                'as' => 'admin.order.getAssignSupplier',
                'uses' => 'OrderController@getAssigneeSupplierOrder'
            ]);

            Route::post('assign-supplier/{id}',[
                'as' => 'admin.order.postAssignSupplier',
                'uses' => 'OrderController@postAssigneeSupplierOrder'
            ]);

            Route::get('assign-supplier-employee/{id}',[
                'as' => 'admin.order.getAssignSupplierEmployee',
                'uses' => 'OrderController@getAssigneeSupplierEmployeeOrder'
            ]);

            Route::post('assign-supplier-employee/{id}',[
                'as' => 'admin.order.postAssignSupplierEmployee',
                'uses' => 'OrderController@postAssigneeSupplierEmployeeOrder'
            ]);
        });

        #endregion

        #region Cate Product
        Route::group([],function (){
            Route::get('list-cate-data',[
                'as' => 'admin.product.cate.getListData',
                'uses' => 'ProductController@getListCateData'
            ]);

            Route::get('list-cate-product',[
                'as' => 'admin.product.cate.getList',
                'uses' => 'ProductController@getListCate'
            ]);

            Route::get('add-cate-product',[
                'as' => 'admin.product.cate.getAdd',
                'uses' => 'ProductController@getAddCate'
            ]);

            Route::post('add-cate-product',[
                'as' => 'admin.product.cate.postAdd',
                'uses' => 'ProductController@postAddCate'
            ]);

            Route::get('edit-cate-product/{id?}',[
                'as' => 'admin.product.cate.getEdit',
                'uses' => 'ProductController@getEditCate'
            ]);

            Route::post('edit-cate-product/{id?}',[
                'as' => 'admin.product.cate.postEdit',
                'uses' => 'ProductController@postEditCate'
            ]);

        });
        #endregion
    });
    #endregion

    #region Admin for sale employee
    Route::group(['prefix'=>'sale','middleware'=>['permission:sale']],function (){
        Route::get('list-order',[
            'as' => 'admin.sale.getListOrder',
            'uses' => 'OrderController@getListOrderSale'
        ]);

        Route::get('change-order/{id}',[
            'as' => 'admin.sale.getChangeOrder',
            'uses' => 'OrderController@getChangeOrderSale'
        ]);

        Route::post('change-order/{id}',[
            'as' => 'admin.sale.postChangeOrder',
            'uses' => 'OrderController@postChangeOrderSale'
        ]);
    });
    #endregion

    #region Admin for supplier employee
    Route::group(['prefix'=>'supplier','middleware'=>['permission:supplier']],function (){
        Route::get('list-order',[
            'as' => 'admin.supplier.getListOrder',
            'uses' => 'OrderController@getListOrderSupplier'
        ]);

        Route::get('change-order-supplier/{id}',[
            'as' => 'admin.supplier.getChangeOrderSupplier',
            'uses' => 'OrderController@getChangeOrderSupplierEmployee'
        ]);

        Route::get('change-order/{id}',[
            'as' => 'admin.supplier.getChangeOrder',
            'uses' => 'OrderController@getChangeOrderSupplier'
        ]);

        Route::post('change-order/{id}',[
            'as' => 'admin.supplier.getChangeOrder',
            'uses' => 'OrderController@postChangeOrderSupplier'
        ]);
    });
    #endregion

    /*
     * ---------------------------------------------------------------------------------------
     * *** Route for admin article controller ***
     * ---------------------------------------------------------------------------------------
     */
    #region admin article controller
    Route::group(['prefix' => 'article', 'middleware' => ['permission:editor']], function(){
        #region Article
        Route::post('/uploader', 'ArticleController@postUpload');

        Route::get('list-article/{id?}',[
            'as' => 'admin.article.getList',
            'uses' => 'ArticleController@getListArticle'
        ]);

        Route::get('list-article-data',[
            'as' => 'admin.article.getListData',
            'uses' => 'ArticleController@getListArticleData'
        ]);

        Route::get('add-article', [
            'as' => 'admin.article.getAdd',
            'uses' => 'ArticleController@getAddArticle'
        ]);

        Route::post('add-article', [
            'as' => 'admin.article.getAdd',
            'uses' => 'ArticleController@postAddArticle'
        ]);

        Route::get('edit-article/{id?}', [
            'as' => 'admin.article.getEdit',
            'uses' => 'ArticleController@getEditArticle'
        ]);

        Route::post('edit-article/{id?}', [
            'as' => 'admin.article.postEdit',
            'uses' => 'ArticleController@postEditArticle'
        ]);

        Route::get('delete-article/{id?}', [
            'as' => 'admin.article.getDelete',
            'uses' => 'ArticleController@getDeleteArticle'
        ]);

        Route::get('list-qna/{id?}',[
            'as' => 'admin.qna.getList',
            'uses' => 'ArticleController@getListQNA'
        ]);

        Route::get('list-qna-data',[
            'as' => 'admin.qna.getListData',
            'uses' => 'ArticleController@getListQNAData'
        ]);

        Route::get('delete-qna/{id}',[
            'as' => 'admin.qna.getDelete',
            'uses' => 'ArticleController@getDeleteQNA'
        ]);

        Route::get('add-qna/{id}',[
            'as' => 'admin.qna.getAdd',
            'uses' => 'ArticleController@getAddQNA'
        ]);

        Route::post('add-qna/{id}',[
            'as' => 'admin.qna.postAdd',
            'uses' => 'ArticleController@postAddQNA'
        ]);

        Route::get('edit-qna/{id}',[
            'as' => 'admin.qna.getEdit',
            'uses' => 'ArticleController@getEditQNA'
        ]);

        Route::post('edit-qna/{id}',[
            'as' => 'admin.qna.postEdit',
            'uses' => 'ArticleController@postEditQNA'
        ]);
        #endregion

        #region recruitment
        Route::get('list-recruitment',[
            'as' => 'admin.recruitment.getList',
            'uses' => 'ArticleController@getListRecruitment'
        ]);

        Route::get('add-recruitment', [
            'as' => 'admin.recruitment.getAdd',
            'uses' => 'ArticleController@getAddRecruitment'
        ]);

        Route::post('add-recruitment', [
            'as' => 'admin.recruitment.getAdd',
            'uses' => 'ArticleController@postAddRecruitment'
        ]);

        Route::get('edit-recruitment/{id?}', [
            'as' => 'admin.article.getEditRecruitment',
            'uses' => 'ArticleController@getEditRecruitment'
        ]);

        Route::post('edit-recruitment/{id?}', [
            'as' => 'admin.article.postEditRecruitment',
            'uses' => 'ArticleController@postEditArticle'
        ]);
        #endregion

        #region Cate Article
        Route::get('list-cate',[
            'as' => 'admin.article.cate.getList',
            'uses' => 'ArticleController@getListCate'
        ]);

        Route::get('list-cate-data',[
            'as' => 'admin.article.cate.getListData',
            'uses' => 'ArticleController@getListCateData'
        ]);


        Route::get('add-cate',[
            'as' => 'admin.article.cate.getAdd',
            'uses' => 'ArticleController@getAddCate'
        ]);

        Route::post('add-cate',[
            'as' => 'admin.article.cate.postAdd',
            'uses' => 'ArticleController@postAddCate'
        ]);

        Route::get('edit-cate/{id?}',[
            'as' => 'admin.article.cate.getEdit',
            'uses' => 'ArticleController@getEditCate'
        ]);

        Route::post('edit-cate/{id?}',[
            'as' => 'admin.article.cate.postEdit',
            'uses' => 'ArticleController@postEditCate'
        ]);
        #endregion
    });
    #endregion

    #region admin user controller
    Route::group(['prefix' => 'user'],function() {
        Route::group(['middleware'=>'role_or_permission:admin|super-admin|sale|editor'],function (){
            Route::group(['middleware'=>'role:admin|super-admin'], function(){
                Route::get('list-user', [
                    'as' => 'admin.user.getList',
                    'uses' => 'UserController@getListUser'
                ]);

                Route::get('list-user-data', [
                    'as' => 'admin.user.getListData',
                    'uses' => 'UserController@getListUserData'
                ]);


                Route::get('list-user-manage', [
                    'as' => 'admin.user.getListManage',
                    'uses' => 'UserController@getListUserManage'
                ]);

                Route::get('list-user-manage-data', [
                    'as' => 'admin.user.getListManageData',
                    'uses' => 'UserController@getListUserManageData'
                ]);


                Route::get('delete-user/{id?}', [
                    'as' => 'admin.user.getDelete',
                    'uses' => 'UserController@getDeleteUser'
                ]);

                Route::get('add-user-manage', [
                    'as' => 'admin.user.getAddManage',
                    'uses' => 'UserController@getAddUserManage'
                ]);

                Route::post('add-user-manage', [
                    'as' => 'admin.user.postAddManage',
                    'uses' => 'UserController@postAddUserManage'
                ]);

            });
            Route::group(['middleware' => ['permission:sale|editor']], function () {

                Route::get('list-user-sale', [
                    'as' => 'admin.user.getListUserRegisterSale',
                    'uses' => 'UserController@getListUserRegisterSale'
                ]);

                Route::get('add-user-sale', [
                    'as' => 'admin.user.getAddUserSale',
                    'uses' => 'UserController@getAddUserSale'
                ]);

                Route::post('add-user-sale', [
                    'as' => 'admin.user.postAddUserSale',
                    'uses' => 'UserController@postAddUserSale'
                ]);

                Route::get('search-user', [
                    'as' => 'admin.user.searchUser',
                    'uses' => 'UserController@getSearchUser'
                ]);

                Route::get('detail-user/{id}',[
                    'as' => 'admin.user.getDetail',
                    'uses' => 'UserController@getDetailUser'
                ]);

                Route::get('list-user-register', [
                    'as' => 'admin.user.getListRegister',
                    'uses' => 'UserController@getListUserRegister'
                ]);

                Route::get('add-user-register', [
                    'as' => 'admin.user.getAddRegister',
                    'uses' => 'UserController@getAddUserRegister'
                ]);

                Route::post('add-user-register', [
                    'as' => 'admin.user.postAddRegister',
                    'uses' => 'UserController@postAddUserRegister'
                ]);

                Route::get('edit-user/{id?}', [
                    'as' => 'admin.user.getEdit',
                    'uses' => 'UserController@getEditUser'
                ]);

                Route::post('edit-user/{id?}', [
                    'as' => 'admin.user.postEdit',
                    'uses' => 'UserController@postEditUser'
                ]);

                Route::get('delete-user-register/{id}', [
                    'as' => 'admin.user.getDeleteRegister',
                    'uses' => 'UserController@getDeleteUserRegister'
                ]);

            });

        });

        Route::group([],function (){
            Route::get('active-user-register/{id}', [
                'as' => 'admin.user.getActiveRegister',
                'uses' => 'UserController@getActiveUserRegister'
            ]);

            Route::get('lock-user/{id}', [
                'as' => 'admin.user.getLock',
                'uses' => 'UserController@getLockUser'
            ]);

            Route::get('unlock-user/{id}', [
                'as' => 'admin.user.getUnLock',
                'uses' => 'UserController@getUnLockUser'
            ]);

            Route::get('email-active-register/{id}', [
                'as' => 'admin.user.getEmailActiveRegister',
                'uses' => 'UserController@getEmailActiveRegister'
            ]);

            Route::get('change-password',[
                'as' => 'admin.user.changePassword',
                'uses' => 'UserController@getChangePass'
            ]);

            Route::post('change-password',[
                'as' => 'admin.user.changePassword',
                'uses' => 'UserController@postChangePass'
            ]);
        });

        Route::group(['middleware' => 'permission:supplier'],function (){
            Route::get('list-supplier',[
                'as' => 'admin.supplier.getList',
                'uses' => 'SupplierController@getListSupplier'
            ]);

            Route::get('list-supplier-data',[
                'as' => 'admin.supplier.getListData',
                'uses' => 'SupplierController@getListSupplierData'
            ]);

            Route::get('active-supplier/{id}',[
                'as' => 'admin.supplier.getActive',
                'uses' => 'SupplierController@getActiveSupllier'
            ]);

            Route::get('add-supplier',[
                'as' => 'admin.supplier.getAdd',
                'uses' => 'SupplierController@getAddSupplier'
            ]);

            Route::post('add-supplier',[
                'as' => 'admin.supplier.postAdd',
                'uses' => 'SupplierController@postAddSupplier'
            ]);

            Route::get('check-supplier/{phone}',[
                'as' => 'admin.supplier.getCheck',
                'uses' => 'SupplierController@getCheckSupplier'
            ]);

            Route::get('edit-supplier/{id}',[
                'as' => 'admin.supplier.getEdit',
                'uses' => 'SupplierController@getEditSupplier'
            ]);

            Route::post('edit-supplier/{id}',[
                'as' => 'admin.supplier.postEdit',
                'uses' => 'SupplierController@postEditSupplier'
            ]);

            Route::get('delete-supplier/{id}',[
                'as' => 'admin.supplier.getDelete',
                'uses' => 'SupplierController@getDeleteSupplier'
            ]);

            Route::get('delete-supplier-image/{id}-{image}',[
                'as' => 'admin.supplier.getDeleteImage',
                'uses' => 'SupplierController@getDeleteImageSupplier'
            ]);

            Route::get('search-supplier',[
                'as' => 'admin.supplier.getSearch',
                'uses' => 'SupplierController@getSearchSupplier'
            ]);

            Route::get('add-user-supplier/{id}', [
                'as' => 'admin.user.getAddUserSupplier',
                'uses' => 'SupplierController@getAddUserSupplier'
            ]);

            Route::post('add-user-supplier/{id}', [
                'as' => 'admin.user.postAddUserSupplier',
                'uses' => 'SupplierController@postAddUserSupplier'
            ]);
        });
    });
    #endregion

    Route::group(['prefix' => 'tag'],function(){

        Route::get('get-all-tag',[
            'as' => 'admin.tag.getAll',
            'uses' => 'AdminController@getAllTag'
        ]);

        Route::get('get-list',[
            'as' => 'admin.tag.getList',
            'uses' => 'AdminController@getListTag'
        ]);

        Route::get('get-list-tag',[
            'as' => 'admin.tag.getListTag',
            'uses' => 'AdminController@getListTag'
        ]);

        Route::get('get-list-data',[
            'as' => 'admin.tag.getListData',
            'uses' => 'AdminController@getListTagData'
        ]);

        Route::get('add-tag',[
            'as' => 'admin.tag.getAdd',
            'uses' => 'AdminController@getAddTag'
        ]);

        Route::post('add-tag',[
            'as' => 'admin.tag.postAdd',
            'uses' => 'AdminController@postAddTag'
        ]);


    });

    #region *** Config ***
    Route::group(['prefix' => 'config','middleware' => ['permission:editor']],function (){
        Route::get('list-config',[
            'middleware' => 'role:super-admin',
            'as' => 'admin.config.getList',
            'uses' => 'AdminController@getListConfig'
        ]);

        Route::get('edit-config/{id}',[
            'middleware' => 'role:super-admin',
            'as' => 'admin.config.getEdit',
            'uses' => 'AdminController@getEditConfig'
        ]);

        Route::post('edit-config/{id}',[
            'middleware' => 'role:super-admin',
            'as' => 'admin.config.postEdit',
            'uses' => 'AdminController@postEditConfig'
        ]);

        Route::get('edit-config-locale/{id}',[
            'as' => 'admin.config.getEditLocale',
            'uses' => 'AdminController@getEditConfigLocale'
        ]);

        Route::post('edit-config-locale/{id}',[
            'as' => 'admin.config.postEditLocale',
            'uses' => 'AdminController@postEditConfigLocale'
        ]);

        Route::post('delete-config-item',[
            'middleware' => 'role:super-admin',
            'as' => 'admin.config.postDeleteItem',
            'uses' => 'AdminController@postDeleteConfigItem'
        ]);


        Route::post('add-config-item',[
            'middleware' => 'role:super-admin',
            'as' => 'admin.config.postAddItem',
            'uses' => 'AdminController@postAddConfigItem'
        ]);

        Route::get('edit-page/{id}',[
            'as' => 'admin.config.getEditPage',
            'uses' => 'AdminController@getEditStaticPage'
        ]);

        Route::post('edit-page/{id}',[
            'as' => 'admin.config.postEditPage',
            'uses' => 'AdminController@postEditStaticPage'
        ]);
    });
    #endregion

    #region *** Review ***
    Route::group(['prefix' => 'rate','middleware' => ['permission:editor']],function (){
        Route::get('list-rate',[
            'as' => 'admin.rate.getList',
            'uses' => 'RateController@getListRate'
        ]);

        Route::get('list-rate-data',[
            'as' => 'admin.rate.getListData',
            'uses' => 'RateController@getListRateData'
        ]);

        Route::get('add-rate',[
            'as' => 'admin.rate.getAdd',
            'uses' => 'RateController@getAddRate'
        ]);

        Route::post('add-rate',[
            'as' => 'admin.rate.postAdd',
            'uses' => 'RateController@postAddRate'
        ]);

        Route::get('edit-rate/{id}',[
            'as' => 'admin.rate.getEdit',
            'uses' => 'RateController@getEditRate'
        ]);

        Route::post('edit-rate/{id}',[
            'as' => 'admin.rate.postEdit',
            'uses' => 'RateController@postEditRate'
        ]);


    });
    #endregion

    #region *** Feedback ***
    Route::group(['prefix' => 'feedback','middleware' => ['permission:customer care']],function (){

        Route::get('list-feedback',[
            'as' => 'admin.feedback.getList',
            'uses' => 'CustomerController@getListFeedback'
        ]);

        Route::get('list-feedback-data',[
            'as' => 'admin.feedback.getListData',
            'uses' => 'CustomerController@getListFeedbackData'
        ]);

        Route::get('edit-feedback/{id}',[
            'as' => 'admin.feedback.getEdit',
            'uses' => 'CustomerController@getEditFeedback'
        ]);

        Route::post('edit-feedback/{id}',[
            'as' => 'admin.feedback.postEdit',
            'uses' => 'CustomerController@postEditFeedback'
        ]);

        Route::get('list-by-order',[
            'as' => 'admin.feedback.getListReview',
            'uses' => 'OrderController@getListReview'
        ]);

        Route::get('list-by-order-data',[
            'as' => 'admin.feedback.getListReviewData',
            'uses' => 'OrderController@getListReviewData'
        ]);


    });
    #endregion
});