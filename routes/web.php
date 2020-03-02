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
    return view('index.index');
})->middleware('checklogin');

Route::get('/create','GoodsController@create')->middleware('checklogin');
Route::post('/store','GoodsController@store')->middleware('checklogin');
Route::get('/index','GoodsController@index')->middleware('checklogin');
Route::post('/destroy','GoodsController@destroy')->middleware('checklogin');
Route::get('/edit/{goods_id}','GoodsController@edit')->middleware('checklogin');
Route::post('/update/{goods_id}','GoodsController@update')->middleware('checklogin');

Route::prefix('brand')->middleware('checklogin')->group(function(){

    Route::get('create','BrandController@create');
    Route::post('store','BrandController@store');
    Route::get('/','BrandController@index');
    Route::get('edit/{id}','BrandController@edit');
    Route::post('update/{id}','BrandController@update');
    Route::get('destroy/{id}','BrandController@destroy');
  
  });
Route::prefix('classify')->middleware('checklogin')->group(function(){
Route::get('/create','ClassifyController@create');
Route::post('/store','ClassifyController@store');
Route::get('/index','ClassifyController@index');
Route::get('/edit/{id}','ClassifyController@edit');
Route::post('/update/{id}','ClassifyController@update');
Route::get('/destroy/{id}','ClassifyController@destroy');
});
Route::get('/login','LoginController@login');
Route::post('/logindo','LoginController@logindo');