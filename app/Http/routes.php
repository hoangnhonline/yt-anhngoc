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
Route::get('/', ['as' => 'login-form', 'uses' => 'UserController@loginForm']);
Route::post('/', ['as' => 'check-login', 'uses' => 'UserController@checkLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'UserController@logout']);
Route::group(['middleware' => 'isAdmin'], function()
{  
    Route::group(['prefix' => 'chu-de'], function () {
        Route::get('/', ['as' => 'chu-de.index', 'uses' => 'ChuDeController@index']);
        Route::get('/create', ['as' => 'chu-de.create', 'uses' => 'ChuDeController@create']);
        Route::post('/store', ['as' => 'chu-de.store', 'uses' => 'ChuDeController@store']);
        Route::get('{id}/edit',   ['as' => 'chu-de.edit', 'uses' => 'ChuDeController@edit']);
        Route::post('/update', ['as' => 'chu-de.update', 'uses' => 'ChuDeController@update']);
        Route::get('{id}/destroy', ['as' => 'chu-de.destroy', 'uses' => 'ChuDeController@destroy']);
    });
    Route::group(['prefix' => 'mail-upload'], function () {
        Route::get('/', ['as' => 'mail-upload.index', 'uses' => 'MailUploadController@index']);
        Route::get('/create', ['as' => 'mail-upload.create', 'uses' => 'MailUploadController@create']);
        Route::post('/store', ['as' => 'mail-upload.store', 'uses' => 'MailUploadController@store']);
        Route::get('{id}/edit',   ['as' => 'mail-upload.edit', 'uses' => 'MailUploadController@edit']);
        Route::post('/update', ['as' => 'mail-upload.update', 'uses' => 'MailUploadController@update']);
        Route::get('{id}/destroy', ['as' => 'mail-upload.destroy', 'uses' => 'MailUploadController@destroy']);
    }); 
    Route::group(['prefix' => 'link-video'], function () {
        Route::post('/check-stt', ['as' => 'check-stt', 'uses' => 'LinkVideoController@checkStt']);
        Route::get('/', ['as' => 'link-video.index', 'uses' => 'LinkVideoController@index']);       
        Route::get('/create', ['as' => 'link-video.create', 'uses' => 'LinkVideoController@create']);       
        
       
        Route::post('/store', ['as' => 'link-video.store', 'uses' => 'LinkVideoController@store']);
        Route::get('{id}/edit',   ['as' => 'link-video.edit', 'uses' => 'LinkVideoController@edit']);
        Route::post('/update', ['as' => 'link-video.update', 'uses' => 'LinkVideoController@update']);
        Route::get('{id}/destroy', ['as' => 'link-video.destroy', 'uses' => 'LinkVideoController@destroy']);
    });   
    Route::group(['prefix' => 'thuoc-tinh-chu-de'], function () {
        Route::get('/create', ['as' => 'thuoc-tinh-chu-de.create', 'uses' => 'ThuocTinhChuDeController@create']);       
        Route::get('/{id_chude?}', ['as' => 'thuoc-tinh-chu-de.index', 'uses' => 'ThuocTinhChuDeController@index']);       
       
        Route::post('/store', ['as' => 'thuoc-tinh-chu-de.store', 'uses' => 'ThuocTinhChuDeController@store']);
        Route::get('{id}/edit',   ['as' => 'thuoc-tinh-chu-de.edit', 'uses' => 'ThuocTinhChuDeController@edit']);
        Route::post('/update', ['as' => 'thuoc-tinh-chu-de.update', 'uses' => 'ThuocTinhChuDeController@update']);
        Route::get('{id}/destroy', ['as' => 'thuoc-tinh-chu-de.destroy', 'uses' => 'ThuocTinhChuDeController@destroy']);
    });
    Route::group(['prefix' => 'account'], function () {
        Route::get('/', ['as' => 'account.index', 'uses' => 'AccountController@index']);
        Route::get('/change-password', ['as' => 'account.change-pass', 'uses' => 'AccountController@changePass']);
        Route::post('/store-password', ['as' => 'account.store-pass', 'uses' => 'AccountController@storeNewPass']);
        Route::get('/update-status/{status}/{id}', ['as' => 'account.update-status', 'uses' => 'AccountController@updateStatus']);
        Route::get('/create', ['as' => 'account.create', 'uses' => 'AccountController@create']);
        Route::post('/store', ['as' => 'account.store', 'uses' => 'AccountController@store']);
        Route::get('{id}/edit',   ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
        Route::post('/update', ['as' => 'account.update', 'uses' => 'AccountController@update']);
        Route::get('{id}/destroy', ['as' => 'account.destroy', 'uses' => 'AccountController@destroy']);
        Route::get('/ajax-list', ['as' => 'account.ajax-list', 'uses' => 'AccountController@ajaxList']);
    });
});

