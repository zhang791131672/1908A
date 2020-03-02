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
Route::get('/create','GoodsController@create');
Route::post('/store','GoodsController@store');
Route::get('/index','GoodsController@index');
Route::post('/destroy','GoodsController@destroy');
Route::get('/edit/{goods_id}','GoodsController@edit');
Route::post('/update/{goods_id}','GoodsController@update');

Route::prefix('brand')->group(function(){

    Route::get('create','BrandController@create');
    Route::post('store','BrandController@store');
    Route::get('/','BrandController@index');
    Route::get('edit/{id}','BrandController@edit');
    Route::post('update/{id}','BrandController@update');
    Route::get('destroy/{id}','BrandController@destroy');
  
  });
Route::prefix('classify')->group(function(){
Route::get('/create','ClassifyController@create');
Route::post('/store','ClassifyController@store');
Route::get('/index','ClassifyController@index');
Route::get('/edit/{id}','ClassifyController@edit');
Route::post('/update/{id}','ClassifyController@update');
Route::get('/destroy/{id}','ClassifyController@destroy');
});