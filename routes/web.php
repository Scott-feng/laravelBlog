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
Route::get('/','PageController@home')->name('home');
Route::resource('topics','TopicController');

Route::resource('users','UserController',['except'=>['index']]);

//session
Route::get('login','SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::delete('logout','SessionController@destroy')->name('logout');

//confrim email
Route::get('signup/confirm/{token}','UsersController@confirmEmail')->name('confirm_email');

//password reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('replies','RepliesController',['only'=>['store','destroy']]);


//prefix admin
Route::prefix('admin')->group(function (){
    Route::view('/','admins.index')->name('admin');
    Route::view('welcome','admins.welcome')->name('admin.welcome');

    //users
    Route::get('users','UserController@index')->name('admin_users.index');
    Route::delete('users/{user}','UserController@destroy')->name('admin_users.destroy');
    //批量删除
    Route::get('users/destroyAll','UserController@destroyAll')->name('admin_users.destroyAll');
    Route::get('users/{user}','UserController@display')->name('admin_users.display');
    Route::patch('users/{user}','UserController@modify')->name('admin_users.modify');


    //Category
    Route::get('categories','CategoryController@index')->name('admin_category.index');
    Route::get('categories/create','CategoryController@create')->name('admin_category.create');
    Route::patch('categories/{category}','CategoryController@update')->name('admin_category.update');
    Route::delete('categories/{category}','CategoryController@destroy')->name('admin_category.destroy');
    //批量删除
    Route::get('categories/destroyAll','CategoryController@destroyAll')->name('admin_category.destroyAll');
    Route::get('categories/{category}','CategoryController@edit')->name('admin_category.edit');
    Route::post('categories','CategoryController@store')->name('admin_category.store');

    //topic
    Route::get('topics','TopicController@adminIndex')->name('admin_topic.index');
});