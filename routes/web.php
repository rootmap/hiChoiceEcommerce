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

Route::get('/', function () {
    return redirect(url('home'));
});

Auth::routes();
Route::get('SendMail','IndexController@TestEmail');
Route::get('user-login','IndexController@loginuser');
Route::get('terms-and-condition','IndexController@termsncondition');
//terms-and-condition

Route::post('user-registration','UserSignUpController@makeSignUp');
Route::get('user-registration','IndexController@viewSignUp');
//Route::get('/home', 'HomeController@index');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register');
    Route::get('home', 'HomeController@index');
});


Route::get('/home','IndexController@index');
Route::get('/Home','IndexController@index');
Route::get('/shopping-cart',['uses'=>'IndexController@getCart','as'=>'site.shopping-cart']);
Route::post('/shopping-cart/{reur}','IndexController@proceedPayment');
Route::get('/checkout-cart/{status}/{token}','IndexController@completeCheckout');
Route::get('/cart/{pid}/{pr}','IndexController@cartProductRemove');
Route::get('/cartrow/{pid}/{reur}','IndexController@cartProductRemoveUrl');

Route::get('/user-dashboard','IndexController@userDashboard');
//Route::get('/wish-list','IndexController@wishList');

Route::post('/wish-list','WishlistController@locateSearch');
Route::get('/wish-list','WishlistController@searchProduct');
Route::get('/wish-list/{cat}/{search}','WishlistController@searchProduct');
Route::get('/wish-list/{cat}/{search}/{limit}/{curpage}','WishlistController@searchProduct');
Route::get('/wish-list/{cat}/{search}/{limit}/{curpage}/{orderby}','WishlistController@searchProduct');



Route::get('/user-order/{user}/total-orders','IndexController@totalUserOrders');
Route::get('/order-detail/{tracking}','IndexController@OrdersDetail');
Route::get('/user-order/{user}/pending-orders','IndexController@pendingUserOrders');
Route::get('/user-order/{user}/cancel-orders','IndexController@cancelUserOrders');
Route::get('/user-order/{user}/paid-orders','IndexController@paidUserOrders');



Route::post('/search','searchController@locateSearch');
Route::get('/search/{cat}/{search}','searchController@searchProduct');
Route::get('/search/{cat}/{search}/{limit}/{curpage}','searchController@searchProduct');
Route::get('/search/{cat}/{search}/{limit}/{curpage}/{orderby}','searchController@searchProduct');




Route::get('/add-to-cart/{id}/{reur}',[
    'uses'=>'IndexController@getAddToCart',
    'as'=>'product.addToCart'
]);

Route::get('/add-to-cart-ajax/{id}/{reur}',[
    'uses'=>'IndexController@getAddToCartajax',
    'as'=>'product.addToCartajax'
]);
Route::get('Contact-Pages/{name}','ContactPagesController@showPage');
Route::get('/shoppingCart',[
    'uses'=>'IndexController@shoppingCart',
    'as'=>'product.shoppingCart'
]);

Route::get('/del-to-cart/{id}',[
    'uses'=>'IndexController@getDelToCart',
    'as'=>'product.delToCart'
]);

Route::get('/del-row-cart/{id}',[
    'uses'=>'IndexController@getDelRowCart',
    'as'=>'product.delRowCart'
]);

Route::get('/clear-to-cart',[
    'uses'=>'IndexController@getClearCart',
    'as'=>'product.ClearCart'
]);

Route::get('/category/{id}/{name}','IndexController@categoryPage');
Route::get('contact-us','IndexController@contactUS');
Route::post('contact-us','IndexController@postContactUS');
Route::get('/sub-category/{id}/{name}','IndexController@subcategoryPage');
Route::get('/product/sub/{cid}/{sub_cat_id}/{name}','IndexController@catsubcategoryPage');
Route::get('/brand/{id}/{name}','IndexController@brandPage');
Route::get('/category/brand/{id}/{cid}/{name}','IndexController@CategorybrandPage');
Route::get('/pro-category/{cid}/brand/{bid}/{name}','IndexController@ProCategorybrandPage'); //lavel 4 cate / brand /to
Route::get('/category/brand/sub/{cid}/{bid}/{sub_cid}/{name}','IndexController@CategorybrandSubPage');
Route::get('/category/{cid}/brand/{bid}/sub/{id}/{name}','IndexController@CategorybrandSubCategoryPage');
Route::get('/category/brand/sub/sub/{cid}/{bid}/{sub_id}/{sub_sub_id}/{name}','IndexController@CategorybrandSubSubCategoryPage');
Route::get('/brand/{id}/{name}/{sec}','IndexController@brandPage');
Route::get('/brand/{id}/{name}/{sec}/{third}','IndexController@brandPage');
Route::get('/brand','IndexController@brand');
Route::get('/product/{id}/{name}','IndexController@productPage');
Route::get('/product/{id}/{name}/{nn}','IndexController@productPage');
Route::get('/product/{id}/{name}/{nn}/{kk}','IndexController@productPage');
Route::get('/cart-new-add/{pid}/{quantity}','IndexController@cartAddFromProduct');
//Route::get('/cart-new-add/{pid}/{quantity}/{unit}/{color}','IndexController@cartAddFromProduct');
Route::get('/cart-new-add/{pid}/{quantity}/{unit}/{color}','IndexController@cartAddFromProductCustom');
Route::get('/cart-new-Color-add/{pid}/{quantity}/{color}','IndexController@cartAddFromProductCustomWU');
Route::get('/cart-new-Color-add/{pid}/{quantity}','IndexController@cartAddFromProduct');
Route::post('/save-cart-info','IndexController@savecart');


Route::get('/product-review/{id}/{reur}',[
    'uses'=>'IndexController@savereview',
    'as'=>'product.addReview'
]);

Route::post('/customer-signup/{reur}','CustomerController@FrontSiteCreate');
Route::get('/customer-profile/view','IndexController@userProfile');
Route::get('/customer-profile/edit','IndexController@userProfile');
Route::post('/customer-profile/save','IndexController@userProfileSave');
Route::post('/login-user-data/{reur}','Auth\AuthController@userLogin');
Route::get('/user-logout','CustomerController@userLogout');

//user Profile
Route::get('/user-profile','CustomerController@userprofile');

//admin section


Route::group(['middleware' => 'auth'], function () {
    //admin panel route
        //Dashboard
        Route::get('admin-ecom/dashboard','dashboardController@index');
        Route::get('admin-ecom/','dashboardController@index');
        //Route::get('/dashboard','dashboardController@index');



        //Payment Method
        Route::get('admin-ecom/paymentmethod','PaymentMethodController@index');
        Route::post('admin-ecom/paymentmethod-add','PaymentMethodController@create');
        Route::post('admin-ecom/paymentmethod-update','PaymentMethodController@update');
        Route::get('admin-ecom/paymentmethod/{id}','PaymentMethodController@show');

        //Shipping Method
        Route::get('admin-ecom/shipping','ShippingController@index');
        Route::post('admin-ecom/shipping-add','ShippingController@create');
        Route::post('admin-ecom/shipping-update','ShippingController@update');
        Route::get('admin-ecom/shipping/{id}','ShippingController@show');

        //SEO
        Route::get('admin-ecom/orders-email','OrderEmailController@index');
        Route::post('admin-ecom/orders-email-add','OrderEmailController@create');
        Route::post('admin-ecom/orders-email-update','OrderEmailController@update');
        Route::get('admin-ecom/orders-email/{id}','OrderEmailController@show');

        //Orders
        Route::get('admin-ecom/orders','OrderController@index');
        Route::get('admin-ecom/orders-report','OrderController@orderReport');
        Route::get('admin-ecom/orders-report-today','OrderController@orderReportToday');
        Route::get('admin-ecom/orders-paid-report','OrderController@orderspaidreport');
        Route::get('admin-ecom/orders-cancel-report','OrderController@orderscancelreport');

        Route::get('admin-ecom/new-orders','OrderController@create');
        Route::post('admin-ecom/orders-add','OrderController@store');
        Route::post('admin-ecom/orders-update','OrderController@update');
        Route::get('admin-ecom/orders/{id}','OrderController@show');
        Route::get('admin-ecom/orders-view/{id}','OrderController@orderdetail');
        Route::post('admin-ecom/payment-request','OrderController@makepayment');
        Route::get('admin-ecom/payment/{amount}/{order_id}','OrderController@payment');

        //Customer
        Route::get('admin-ecom/customer-report','CustomerController@report');
        Route::get('admin-ecom/customer','CustomerController@index');
        Route::get('admin-ecom/new-customer','CustomerController@create');
        Route::post('admin-ecom/customer-add','CustomerController@store');
        Route::post('admin-ecom/customer-update','CustomerController@update');
        Route::get('admin-ecom/customer/{id}','CustomerController@show');


        //SEO
        Route::get('admin-ecom/seo','SeoController@index');
        Route::post('admin-ecom/seo-add','SeoController@create');
        Route::post('admin-ecom/seo-update','SeoController@update');
        Route::get('admin-ecom/seo/{id}','SeoController@show');
        
        //QRCode
        Route::get('admin-ecom/qrcode','QRCodeController@index');
        Route::post('admin-ecom/qrcode-add','QRCodeController@create');
        Route::post('admin-ecom/qrcode-update','QRCodeController@update');



        //category
        Route::get('admin-ecom/category','CategoryController@index');
        Route::post('admin-ecom/category-add','CategoryController@create');
        Route::post('admin-ecom/category-update','CategoryController@update');
        Route::get('admin-ecom/category/{id}','CategoryController@show');

        //sub-category
        Route::get('admin-ecom/sub-category','SubCategoryController@index');
        Route::post('admin-ecom/sub-category-add','SubCategoryController@create');
        Route::post('admin-ecom/sub-category-update','SubCategoryController@update');
        Route::get('admin-ecom/sub-category/{id}','SubCategoryController@show');
        
        //sub-sub-category
        Route::get('admin-ecom/sub-sub-category','SubSubCategoryController@index');
        Route::post('admin-ecom/sub-sub-category-add','SubSubCategoryController@create');
        Route::post('admin-ecom/sub-sub-category-update','SubSubCategoryController@update');
        Route::get('admin-ecom/sub-sub-category/{id}','SubSubCategoryController@show');

        //Tag
        Route::get('admin-ecom/tag','TagController@index');
        Route::post('admin-ecom/tag-add','TagController@create');
        Route::post('admin-ecom/tag-update','TagController@update');
        Route::get('admin-ecom/tag/{id}','TagController@show');
        
        //Color
        Route::get('admin-ecom/color','ProductColorController@index');
        Route::post('admin-ecom/color-add','ProductColorController@create');
        Route::post('admin-ecom/color-update','ProductColorController@update');
        Route::get('admin-ecom/color/{id}','ProductColorController@show');
        
        //Unit Type
        Route::get('admin-ecom/unit-type','ProductUnitTypeController@index');
        Route::post('admin-ecom/unit-type-add','ProductUnitTypeController@create');
        Route::post('admin-ecom/unit-type-update','ProductUnitTypeController@update');
        Route::get('admin-ecom/unit-type/{id}','ProductUnitTypeController@show');

        //Currency
        Route::get('admin-ecom/currency','CurrencyController@index');
        Route::post('admin-ecom/currency-add','CurrencyController@create');
        Route::post('admin-ecom/currency-update','CurrencyController@update');
        Route::get('admin-ecom/currency/{id}','CurrencyController@show');

        //Slider
        Route::get('admin-ecom/slider','SliderController@index');
        Route::post('admin-ecom/slider-add','SliderController@create');
        Route::post('admin-ecom/slider-update','SliderController@update');
        Route::get('admin-ecom/slider/{id}','SliderController@show');

        //Contact Pages
        Route::get('admin-ecom/Contact-Pages','ContactPagesController@index');
        Route::post('admin-ecom/Contact-Pages-add','ContactPagesController@create');
        Route::post('admin-ecom/Contact-Pages-update','ContactPagesController@update');
        Route::get('admin-ecom/Contact-Pages/{id}','ContactPagesController@show');


        //Brand
        Route::get('admin-ecom/brand','BrandController@index');
        Route::post('admin-ecom/brand-add','BrandController@create');
        Route::post('admin-ecom/brand-update','BrandController@update');
        Route::get('admin-ecom/brand/{id}','BrandController@show');


        //Product
        Route::get('admin-ecom/product','ProductController@index');
        Route::post('admin-ecom/product/filter/extra/category','ProductController@SubSubCategory');
        Route::post('admin-ecom/product/filter/dextra/category','ProductController@DedSubCategory');//2
        Route::post('admin-ecom/product/filter/dextrashow/brand','ProductController@DedSubCategoryShowBrand');//4
        Route::post('admin-ecom/product/filter/extra/json/category','ProductController@JsonSubSubCategory');
        Route::get('admin-ecom/new-product','ProductController@create');
        Route::post('admin-ecom/product-add','ProductController@store');
        Route::post('admin-ecom/product-update','ProductController@update');
        Route::get('admin-ecom/product/{id}','ProductController@show');

        //Product Tag
        Route::get('admin-ecom/product-tag','ProductTagController@index');
        Route::post('admin-ecom/product-tag-add','ProductTagController@create');
        Route::post('admin-ecom/product-tag-update','ProductTagController@update');
        Route::get('admin-ecom/product-tag/{id}','ProductTagController@show');


        //Site Customer Support
        Route::get('admin-ecom/customer-support','CustomerSupportController@index');
        Route::post('admin-ecom/customer-support-add','CustomerSupportController@create');
        Route::post('admin-ecom/customer-support-update','CustomerSupportController@update');

        //Site contact-detail
        Route::get('admin-ecom/contact-detail','ContactDetailController@index');
        Route::post('admin-ecom/contact-detail-add','ContactDetailController@create');
        Route::post('admin-ecom/contact-detail-update','ContactDetailController@update');

        //Language
        Route::get('admin-ecom/lang','LanguageController@index');
        Route::post('admin-ecom/lang-add','LanguageController@create');
        Route::post('admin-ecom/lang-update','LanguageController@update');
        Route::get('admin-ecom/lang/{id}','LanguageController@show');


        //json route

        //Payment Method
        Route::get('admin-ecom/paymentmethod-data','PaymentMethodController@showjson');
        Route::get('admin-ecom/paymentmethod-delete/{id}','PaymentMethodController@destroy');


        //Shipping
        Route::get('admin-ecom/shipping-data','ShippingController@showjson');
        Route::get('admin-ecom/shipping-delete/{id}','ShippingController@destroy');


        //Order
        Route::get('admin-ecom/orders-data','OrderController@showjson');
        Route::get('admin-ecom/orders-report-data','OrderController@showReportjson');
        Route::get('admin-ecom/orders-report-today-data','OrderController@showReporttodayjson');
        Route::get('admin-ecom/orders-paid-data','OrderController@showjsonpaid');
        Route::get('admin-ecom/orders-pending-data','OrderController@showjsonpending');
        Route::get('admin-ecom/orders-cancel-data','OrderController@showjsoncancel');

        Route::get('admin-ecom/orders-delete/{id}','OrderController@destroy');
        Route::post('admin-ecom/orders-filter-subcat-data','OrderController@filterorderproduct');


        //customer
        Route::get('admin-ecom/customer-data-report','CustomerController@showReportjson');
        Route::get('admin-ecom/customer-orders-report/{id}','CustomerController@showCustomerReportjson');
        Route::get('admin-ecom/customer-data','CustomerController@showjson');
        Route::get('admin-ecom/customer-delete/{id}','CustomerController@destroy');

        //category
        Route::get('admin-ecom/category-data','CategoryController@showjson');
        Route::get('admin-ecom/category-delete/{id}','CategoryController@destroy');

        //sub-category
        Route::get('admin-ecom/sub-category-data','SubCategoryController@showjson');
        Route::get('admin-ecom/sub-category-delete/{id}','SubCategoryController@destroy');
        
        //sub-category
        Route::get('admin-ecom/sub-sub-category-data','SubSubCategoryController@showjson');
        Route::post('admin-ecom/sub-sub-category-data/sub-category','SubSubCategoryController@showjsonSubCategory');
        Route::get('admin-ecom/sub-sub-category-delete/{id}','SubSubCategoryController@destroy');

        //tag
        Route::get('admin-ecom/tag-data','TagController@showjson');
        Route::get('admin-ecom/tag-delete/{id}','TagController@destroy');
        
        //Color
        Route::get('admin-ecom/color-data','ProductColorController@showjson');
        Route::get('admin-ecom/color-delete/{id}','ProductColorController@destroy');


        //Unit Type
        Route::get('admin-ecom/unit-type-data','ProductUnitTypeController@showjson');
        Route::get('admin-ecom/unit-type-delete/{id}','ProductUnitTypeController@destroy');

        //currency
        Route::get('admin-ecom/currency-data','CurrencyController@showjson');
        Route::get('admin-ecom/currency-delete/{id}','CurrencyController@destroy');

        //Brand
        Route::get('admin-ecom/brand-data','BrandController@showjson');
        Route::get('admin-ecom/brand-delete/{id}','BrandController@destroy');

        //Slider
        Route::get('admin-ecom/slider-data','SliderController@showjson');
        Route::get('admin-ecom/slider-delete/{id}','SliderController@destroy');

        //Contact Pages
        Route::get('admin-ecom/Contact-Pages-data','ContactPagesController@showjson');
        Route::get('admin-ecom/Contact-Pages-delete/{id}','ContactPagesController@destroy');




        //Product
        Route::get('admin-ecom/product-data','ProductController@showjson');
        Route::get('admin-ecom/product-delete/{id}','ProductController@destroy');
        Route::post('admin-ecom/product-filter-subcat-data','ProductController@filtersubcat');

        //Product Tag
        Route::get('admin-ecom/product-tag-data','ProductTagController@showjson');
        Route::get('admin-ecom/product-tag-delete/{id}','ProductTagController@destroy');

        //Language Tag
        Route::get('admin-ecom/lang-data','LanguageController@showjson');
        Route::get('admin-ecom/lang-delete/{id}','LanguageController@destroy');
        
        
        //Admin Info
        Route::get('admin-ecom/Admin-Info','AdminInfoController@index');
        Route::get('admin-ecom/Admin-Info-add','AdminInfoController@createIndex');
        Route::post('admin-ecom/Admin-Info-add','AdminInfoController@create');
        Route::post('admin-ecom/Admin-Info-update','AdminInfoController@update');
        Route::get('admin-ecom/Admin-Info/{id}','AdminInfoController@show');
        Route::get('admin-ecom/Admin-Info/User/{id}','AdminInfoController@Reshow');
                
        Route::get('admin-ecom/Admin-Info-Data','AdminInfoController@showjson');
        Route::get('admin-ecom/Admin-Info-delete/{id}','AdminInfoController@destroy');
        

        
    //admin panel route
});