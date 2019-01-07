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

//forntend

Route::get('/','HomeController@index');
Route::get('/product_by_category/{category_id}','HomeController@product_by_category');
Route::get('/product_by_manufacture/{manufacture_id}','HomeController@product_by_manufacture');
Route::get('/product_detail/{product_id}','HomeController@product_detail');
// Route::get('/product_detail','HomeController@product_detail');




//Backend

Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::post('/admin-dashboard','AdminController@dashboard');
Route::get('/logout','AdminController@logout');

//category
Route::get('/add_category','CategoryController@index');
Route::get('/all_category','CategoryController@all_category');
Route::post('/save-category','CategoryController@save_category');
Route::get('/edit_category/{category_id}','CategoryController@edit_category');
Route::post('/update_category/{category_id}','CategoryController@update_category');
Route::get('/delete_category/{category_id}','CategoryController@delete_category');
Route::get('/unactive_category/{category_id}','CategoryController@unactive_category');
Route::get('/active_category/{category_id}','CategoryController@active_category');

//manufacture or barnds routes are here
Route::get('/all_manufacture','ManufactureController@all_manufacture');
Route::get('/add_manufacture','ManufactureController@index');
Route::post('/save_manufacture','ManufactureController@save_manufacture')->name('saveManufacture');
Route::get('/edit_manufacture/{manufacture_id}','ManufactureController@edit_manufacture');
Route::post('/update_manufacture/{manufacture_id}','ManufactureController@update_manufacture');
Route::get('/delete_manufacture/{manufacture_id}','ManufactureController@delete_manufacture');
Route::get('/unactive_manufacture/{manufacture_id}','ManufactureController@unactive_manufacture');
Route::get('/active_manufacture/{manufacture_id}','ManufactureController@active_manufacture');

//products in picme

Route::get('/add_product','ProductController@index');
Route::post('/save_product','ProductController@save_product');
Route::get('/all_product','ProductController@all_product');
Route::get('/edit_product/{product_id}','ProductController@edit_product');
Route::get('/unactive_product/{product_id}','ProductController@unactive_product');
Route::get('/active_product/{product_id}','ProductController@active_product');
Route::post('/update_product/{product_id}','ProductController@update_product');
Route::get('/delete_product/{product_id}','ProductControllerr@delete_product');

//slide in picme

Route::get('/add_slide','SliderController@index');
Route::post('/save_slide','SliderController@save_slide');
Route::get('/all_slide','SliderController@all_slide');
Route::get('/edit_slide/{slider_id}','SliderController@edit_slide');
Route::get('/unactive_slide/{slider_id}','SliderController@unactive_slide');
Route::get('/active_slide/{slider_id}','SliderController@active_slide');
Route::post('/update_slide/{slider_id}','SliderController@update_slide');
Route::get('/delete_slide/{slider_id}','SliderController@delete_slide');