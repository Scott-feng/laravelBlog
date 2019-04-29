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

Route::post('/favorite/{topic}','TopicController@favorites')->name('favorites');
Route::post('/unfavorite/{topic}','TopicController@unFavorites')->name('unFavorites');

Route::resource('users','UserController',['except'=>['index']]);
Route::get('my_favorites', 'UsersController@myFavorites')->middleware('auth');

Route::get('categories/{category}','CategoryController@show')->name('categories.show');

//session
Route::get('login','SessionController@create')->name('login');
Route::post('login','SessionController@store')->name('login');
Route::delete('logout','SessionController@destroy')->name('logout');

//tag
Route::get('tags/{tag}','TagController@show')->name('tags.show');

//confrim email
Route::get('signup/confirm/{token}','UserController@confirmEmail')->name('confirm_email');

//password reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('replies','RepliesController',['only'=>['store','destroy']]);

//about
Route::view('/about','pages.about');

//github
Route::get('login/github','SessionController@github')->name('login.github');
Route::get('github/callback','SessionController@githubCallback');

//search
Route::get('search/','SearchController@search')->name('scout.search');

//message
Route::post('messages','MessageController@store')->name('messages.store');
Route::get('messages/create','MessageController@create')->name('messages.create');
Route::get('notifications/','NotificationsController@index')->name('notifications.index');

//prefix admin
Route::group(['prefix' => 'admin','middleware'=>['auth','IsAdmin']],function () {

        Route::view('/', 'admins.index')->name('admin');
        Route::view('welcome', 'admins.welcome')->name('admin.welcome');

        //users
        Route::get('users', 'UserController@index')->name('admin_users.index');
        Route::delete('users/{user}', 'UserController@destroy')->name('admin_users.destroy');
        //批量删除
        Route::get('users/destroyAll', 'UserController@destroyAll')->name('admin_users.destroyAll');
        Route::get('users/{user}', 'UserController@display')->name('admin_users.display');
        Route::patch('users/{user}', 'UserController@modify')->name('admin_users.modify');

        //Category
        Route::get('categories', 'CategoryController@index')->name('admin_category.index');
        Route::get('categories/create', 'CategoryController@create')->name('admin_category.create');
        Route::patch('categories/{category}', 'CategoryController@update')->name('admin_category.update');
        Route::delete('categories/{category}', 'CategoryController@destroy')->name('admin_category.destroy');
        //批量删除
        Route::get('categories/destroyAll', 'CategoryController@destroyAll')->name('admin_category.destroyAll');
        Route::get('categories/{category}', 'CategoryController@edit')->name('admin_category.edit');
        Route::post('categories', 'CategoryController@store')->name('admin_category.store');


        //topic
        Route::get('topics/create', 'TopicController@create')->name('admin_topic.create');
        Route::post('topics', 'TopicController@store')->name('admin_topic.store');
        Route::get('topics', 'TopicController@adminIndex')->name('admin_topic.index');
        Route::delete('topics/{topic}', 'TopicController@destroy')->name('admin_topic.destroy');
        Route::get('topics/{topic}', 'TopicController@destroyAll')->name('admin_topic.destroyAll');
        Route::get('topics/{topic}/edit', 'TopicController@edit')->name('admin_topic.edit');
        Route::patch('topics/{topic}', 'TopicController@update')->name('admin_topic.update');

        //link
        Route::get('links','LinkController@index')->name('admin_link.index');
        Route::get('links/create','LinkController@create')->name('admin_link.create');
        Route::get('links/{link}','LinkController@edit')->name('admin_link.edit');
        Route::patch('links/{link}','LinkController@update')->name('admin_link.update');
        Route::delete('links/{link}','LinkController@destroy')->name('admin_link.destroy');
        Route::get('links/destroyAll','LinkController@destroyAll')->name('admin_link.destroyAll');
        Route::get('links/create','LinkController@create')->name('admin_link.create');
        Route::post('links','LinkController@store')->name('admin_link.store');

        //tag
        Route::get('tags','TagController@index')->name('admin_tag.index');
        Route::get('tags/{tag}/edit','TagController@edit')->name('admin_tag.edit');
        Route::get('tags/create','TagController@create')->name('admin_tag.create');
        Route::post('tags/', 'TagController@store')->name('admin_tag.store');

        Route::patch('tags/{tag}','TagController@update')->name('admin_tag.update');
        Route::delete('tags/{tag}','TagController@destroy')->name('admin_tag.destroy');
        Route::get('tags/destroyAll','TagController@destroyAll')->name('admin_tag.destroyAll');






});
