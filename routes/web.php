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
    return view('template.master');
});

Route::post('website-register', 'LoginController@storeRegister')->name('store.register');
Route::post('website-login', 'LoginController@postLogin')->name('post.login');
Route::get('website-logout', 'LoginController@getLogout')->name('get.logout');

Route::group(['prefix' => 'website'], function() {
    Route::get('/','WebsiteController@index')->name('website.home');
    Route::get('/detail/{id}', 'WebsiteController@detail')->name('website.detail');
    Route::get('/define','WebsiteController@getDefine')->name('website.define');
    Route::get('/shirt-label', 'WebsiteController@getShirtLabel')->name('website.shirt.label');
    Route::post('/comment/store', 'WebsiteController@storeComment')->name('website.shirt.comment');
    Route::get('/blacklist', 'WebsiteController@getBlacklist')->name('website.blacklist');

    // Route::get('/','WebsiteController@index')->name('website.home');
    // Route::get('/create','WebsiteController@create')->name('typeProduct.create');
});

Route::group(['prefix' => 'type-product'], function() {
    Route::get('/','TypeProductController@index')->name('typeProduct.index');
    Route::get('/create','TypeProductController@create')->name('typeProduct.create');
    Route::post('/store','TypeProductController@store')->name('typeProduct.store');
    Route::get('/edit/{id}','TypeProductController@edit')->name('typeProduct.edit');
    Route::post('/update','TypeProductController@update')->name('typeProduct.update');
    Route::get('/delete/{id}', 'TypeProductController@delete')->name('typeProduct.delete');
});

Route::group(['prefix' => 'blacklist'], function() {
    Route::get('/','BlacklistController@index')->name('blacklist.index');
    Route::get('/edit/{id}','BlacklistController@edit')->name('blacklist.edit');
    Route::post('/update','BlacklistController@update')->name('blacklist.update');
    // Route::get('/delete/{id}', 'BlacklistController@delete')->name('blacklist.delete');
});

Route::group(['prefix' => 'profile'], function() {
    Route::get('/shop/edit/{id}','ProfileController@editShop')->name('profile.edit.shop');
    Route::get('/member/edit/{id}','ProfileController@editMember')->name('profile.edit.member');

    Route::post('/shop/update','ProfileController@updateShop')->name('profile.update.shop');
    Route::post('/member/update','ProfileController@updateMember')->name('profile.update.member');

});

Route::group(['prefix' => 'product'], function() {
    Route::get('/','ProductController@index')->name('product.index');
    Route::get('/create','ProductController@create')->name('product.create');
    Route::post('/store','ProductController@store')->name('product.store');
    Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
    Route::post('/update','ProductController@update')->name('product.update');
    Route::get('/delete/{id}', 'ProductController@delete')->name('product.delete');
    Route::get('/delete-image/{id}','ProductController@deleteImage')->name('product.deleteImage');
    Route::get('/comment/{id}','ProductController@getComment')->name('product.comment');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
