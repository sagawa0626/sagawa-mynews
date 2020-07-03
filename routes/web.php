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
    return view('welcome');
});

//　ユーザーから/admin/〜/〜のアクセスが来たら
//　Controllerの@〜に渡すという指示を送っている
//　'prefix' => 'admin'はhttp://XXXXXX.jp/admin/から始まるURL
//　groupで囲うと全てがhttp://XXXXXX.jp/admin/から始まるURLが
//　適応されるようになる。逆にadminから始まるURLでないなら勿論適応されない
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('news/create', 'Admin\NewsController@create')->name('NewsCreate');
    
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::post('profile/create', 'Admin\ProfileController@create')->name('ProfileCreate');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
    Route::post('profile/edit', 'Admin\ProfileController@update');
    Route::get('profile', 'Admin\ProfileController@index')->name('ProfileIndex');
    Route::get('profile/delete', 'Admin\ProfileController@delete');
    
    Route::get('news', 'Admin\NewsController@index')->name('NewsIndex');
    Route::get('news/edit', 'Admin\NewsController@edit');
    Route::post('news/edit', 'Admin\NewsController@update');
    Route::get('news/delete', 'Admin\NewsController@delete');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'NewsController@index');
Route::get('/profile', 'ProfileController@index');
