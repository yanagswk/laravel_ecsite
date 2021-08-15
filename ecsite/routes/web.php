<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 認証機能
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// 商品一覧表示
Route::get('/', 'ItemController@index');

// 商品詳細表示
Route::get('/item/{item}', 'ItemController@show');

// 商品をカートに追加
Route::post('/cartitem', 'CartItemController@store');

// カート一覧表示
Route::get('/cartitem', 'CartItemController@index');

// カートの商品を削除
Route::delete('/cartitem/{cartItem}', 'CartItemController@destroy');

// カートの商品数を更新
Route::put('/cartitem/{cartItem}', 'CartItemController@update');

// 購入画面表示
Route::get('/buy', 'BuyController@index');

// 郵送先入力の処理
Route::post('/buy', 'BuyController@store');
