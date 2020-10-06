<?php

use Illuminate\Support\Facades\Route;



Route::namespace('User')->group(function () {

    //Start User route
    Route::get('/', 'ForntendController@Index');

    Route::prefix('products')->group(function () {
        Route::get('/all', 'ProductController@AllProducts')->name('user.all.products');
        Route::get('/sub/{id}', 'ProductController@SubProducts')->name('user.sub.products');
    });

    Route::prefix('outlet')->group(function () {
        Route::get('/all', 'OutlateController@All')->name('user.outlate.all');
        Route::get('/sub-area/{name}', 'OutlateController@SubArea')->name('user.outlate.subarea');
    });

    Route::prefix('franchisee')->group(function () {
        Route::get('/apply', 'FranchiseeController@apply')->name('user.franchisee.apply');
        Route::post('/apply-action', 'FranchiseeController@apply_action')->name('user.franchisee.apply.action');
    });

    //Route::get('/products', 'ForntendController@AllProducts');

    Route::get('/products-details/{id}', 'ForntendController@ProductsDetails');
    Route::get('/posts', 'ForntendController@AllPosts');
    Route::get('/posts-details/{id}', 'ForntendController@PostsDetails');
    Route::get('/about', 'ForntendController@About');
    Route::get('/posts-details/{id}', 'ForntendController@PostsDetails');
    Route::get('/outlate/{division}', 'ForntendController@Outlate');
    Route::get('/contact', 'ForntendController@Contact');
    Route::post('/contact-mail', 'ForntendController@ContactMail')->name('contact.mail');
    Route::get('/promotions', 'ForntendController@Promotions');
    Route::get('/promotion-details/{id}', 'ForntendController@PromotionDetails');


    //End User route

});


Route::get('/{url}', function ($url) {

    return Redirect::to('/login');
})->where(['url' => 'admin|adminlogin|admin-login']);

// Route::namespace('Admin')->prefix('admin')->group(function(){
//     Route::get('/', 'LoginController@Index')->name('admin.login');
//     Route::post('/login-action', 'LoginController@LoginAction')->name('admin.login.action');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::namespace('Admin')->prefix('admin')->group(function () {

    Route::get('/dashboard', 'HomeController@Dashboard')->name('admin.dashboard');

    //Role
    Route::namespace('Role')->prefix('role')->group(function () {
        Route::get('/all', 'Rolecontroller@All')->name('role.all');
        Route::post('/store', 'Rolecontroller@Store');
        Route::get('/edit/{id}', 'Rolecontroller@Edit');
        Route::post('/update', 'Rolecontroller@Update');
        Route::get('/delete/{id}', 'Rolecontroller@Delete');
    });

    //Category
    Route::namespace('Category')->prefix('category')->group(function () {
        Route::get('/all', 'CategoryController@All')->name('admin.category.all');
        Route::post('/store', 'CategoryController@Store');
        Route::get('/edit/{id}', 'CategoryController@Edit');
        Route::post('/update', 'CategoryController@Update');
        Route::get('/delete/{id}', 'CategoryController@Delete');
    });

    //subcategory
    Route::namespace('Subcategory')->prefix('subcategory')->group(function () {
        Route::get('/all', 'SubcategoryController@All')->name('admin.subcategory.all');
        Route::post('/store', 'SubcategoryController@Store');
        Route::get('/edit/{id}', 'SubcategoryController@Edit');
        Route::post('/update', 'SubcategoryController@Update');
        Route::get('/delete/{id}', 'SubcategoryController@Delete');
    });


    //User
    Route::namespace('User')->prefix('user')->group(function () {
        Route::get('/all', 'UserController@All')->name('user.all');
        Route::post('/store', 'UserController@Store');
        Route::get('/edit/{id}', 'UserController@Edit');
        Route::post('/update', 'UserController@Update');
        Route::get('/delete/{id}', 'UserController@Delete');

        //Roles
        Route::get('/role-edit/{id}', 'UserController@RoleEdit');
        Route::post('/role-store', 'UserController@RoleStore');
    });

    //Post
    Route::namespace('Post')->prefix('post')->group(function () {
        Route::get('/all', 'PostController@All')->name('post.all');
        Route::post('/store', 'PostController@Store');
        Route::get('/edit/{id}', 'PostController@Edit');
        Route::post('/update', 'PostController@Update');
        Route::get('/delete/{id}', 'PostController@Delete');
        Route::get('/status/{id}/{val}', 'PostController@Status');
    });

    //Product
    Route::namespace('Product')->prefix('product')->group(function () {
        Route::get('/all', 'ProductController@All')->name('product.all');
        Route::post('/store', 'ProductController@Store');
        Route::get('/edit/{id}', 'ProductController@Edit');
        Route::post('/update', 'ProductController@Update');
        Route::get('/delete/{id}', 'ProductController@Delete');
        Route::get('/status/{id}/{val}', 'ProductController@Status');

        Route::get('/subcategory', 'ProductController@Subcategory')->name('product.subcategory');
    });

    //Promotion
    Route::namespace('Promotion')->prefix('promotion')->group(function () {
        Route::get('/all', 'PromotionController@All')->name('promotion.all');
        Route::post('/store', 'PromotionController@Store');
        Route::get('/edit/{id}', 'PromotionController@Edit');
        Route::post('/update', 'PromotionController@Update');
        Route::get('/delete/{id}', 'PromotionController@Delete');
        Route::get('/status/{id}/{val}', 'PromotionController@Status');
    });

    //About
    Route::namespace('About')->prefix('about')->group(function () {
        Route::get('/all', 'AboutController@All')->name('about.all');
        Route::post('/store', 'AboutController@Store');
        Route::get('/edit/{id}', 'AboutController@Edit');
        Route::post('/update', 'AboutController@Update');
        Route::get('/delete/{id}', 'AboutController@Delete');
        Route::get('/status/{id}/{val}', 'AboutController@Status');
    });

    //Contact
    Route::namespace('Contact')->prefix('contact')->group(function () {
        Route::get('/all', 'ContactController@All')->name('contact.all');
        Route::post('/store', 'ContactController@Store');
        Route::get('/edit/{id}', 'ContactController@Edit');
        Route::post('/update', 'ContactController@Update');
        Route::get('/delete/{id}', 'ContactController@Delete');
        Route::get('/status/{id}/{val}', 'ContactController@Status');
    });

    //Outlate
    Route::namespace('Outlate')->prefix('Outlet')->group(function () {
        Route::get('/all', 'OutlateController@All')->name('outlet.all');
        Route::post('/store', 'OutlateController@Store');
        Route::get('/edit/{id}', 'OutlateController@Edit');
        Route::post('/update', 'OutlateController@Update');
        Route::get('/delete/{id}', 'OutlateController@Delete');
        Route::get('/status/{id}/{val}', 'OutlateController@Status');
    });

    //Slider
    Route::namespace('Slider')->prefix('slider')->group(function () {
        Route::get('/all', 'SliderController@All')->name('slider.all');
        Route::post('/store', 'SliderController@Store');
        Route::get('/edit/{id}', 'SliderController@Edit');
        Route::post('/update', 'SliderController@Update');
        Route::get('/delete/{id}', 'SliderController@Delete');
        Route::get('/status/{id}/{val}', 'SliderController@Status');
    });

    //Recomendation
    Route::namespace('Recomendation')->prefix('recomendation')->group(function () {
        Route::get('/franchisee', 'FranchiseeController@Franchisee')->name('recomendation.franchisee');
        Route::get('/message', 'MessageController@Message')->name('recomendation.message');
    });
});
