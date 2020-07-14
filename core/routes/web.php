<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'guest'], function () {
    Route::get('/register','LoginRegisterController@registerPage')->name('register');
    Route::post('/register','LoginRegisterController@register');
    Route::get('/login','LoginRegisterController@loginPage')->name('login');
    Route::post('/login','LoginRegisterController@login');
    Route::get('reset-password','LoginRegisterController@resetPage')->name('reset');
    Route::post('reset-password','LoginRegisterController@resetPasswordSendMail');

    Route::get('reset-form','LoginRegisterController@resetform')->name('reset_form');
    Route::post('reset-form','LoginRegisterController@resetformsubmit');
});


Route::group(['middleware'=>'auth'],function(){
Route::get('/','UserController@home')->name('home');
Route::get('/logout','UserController@logout')->name('logout');

Route::post('transaction','UserController@transaction')->name('transaction');


Route::get('reffered-user','UserController@refferedUser')->name('reffered');

Route::post('reffer-email','UserController@refferEmail')->name('reffer_email');

});



// admin Route


Route::group(['prefix'=>'admin','middleware'=>'guest:admin'],function(){
    Route::get('/login','AdminController@index')->name('admin.login');
    Route::post('/login','AdminController@login');
});


Route::group(['prefix'=>'admin','middleware'=>'auth:admin'],function(){
    Route::get('/home','AdminController@home')->name('admin.home');
    Route::get('/logout','AdminController@logout')->name('admin.logout');
    Route::get('/currency','AdminController@currency')->name('admin.currency');
    Route::post('/currency','AdminController@addCurrency');
    Route::post('/currency/change','AdminController@changeCurrency')->name('admin.changeCurrency');

    Route::post('/sign/bonus','AdminController@signUpBonus')->name('admin.bonus');
    Route::get('/setting','AdminController@settingView')->name('admin.setting');
    Route::post('/setting','AdminController@setting');

    Route::get('list','AdminController@userListPage')->name('admin.list');

    Route::post('update','AdminController@updateBalance')->name('admin.update');

    Route::get('login-as-user/{id}','AdminController@loginUsingId')->name('login-as-user');

    Route::get('get-transaction','AdminController@transaction')->name('admin.transaction');
    Route::get('user-info/{id}','AdminController@userInfo')->name('admin.user');

    Route::get('give-comission','AdminController@giveBalanceComission')->name('admin.givecomission');
    Route::post('search','AdminController@search')->name('admin.search');

});




