<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Categories Function
Route::get('/Categories', 'CategoriesController@Categories');

Route::post('/AddNewCategories', 'CategoriesController@AddNewCategories');

Route::get('/delete_Categories', 'CategoriesController@delete_Categories');

Route::get('/edit_Categories', 'CategoriesController@edit_Categories');

Route::post('/submit_edit_Categories', 'CategoriesController@submit_edit_Categories');


//Sub_Categories Function
Route::get('/Sub_Categories', 'Sub_CategoriesController@Sub_Categories');

Route::post('/AddNewSub_Categories', 'Sub_CategoriesController@AddNewSub_Categories');

Route::get('/delete_Sub_Categories', 'Sub_CategoriesController@delete_Sub_Categories');

Route::get('/edit_Sub_Categories', 'Sub_CategoriesController@edit_Sub_Categories');

Route::post('/submit_edit_Sub_Categories', 'Sub_CategoriesController@submit_edit_Sub_Categories');


//Stores Function
Route::get('/store', 'StoreController@store');

Route::post('/AddNewstore', 'StoreController@AddNewstore');

Route::get('/delete_store', 'StoreController@delete_store');

Route::get('/edit_store', 'StoreController@edit_store');

Route::get('/edit_profile_store', 'StoreController@edit_profile_store');

Route::post('/submit_edit_store', 'StoreController@submit_edit_store');


//Product Function
Route::get('/view_all_product', 'productController@view_all_product');

Route::get('/view_product', 'productController@view_product');

Route::get('/product', 'productController@Product');

Route::get('/getProduct', 'productController@getProduct');

Route::get('/getProduct2', 'productController@getProduct');

Route::post('/AddNewProduct', 'productController@AddNewProduct');

Route::get('/delete_Product', 'productController@delete_Product');

Route::get('/edit_Product', 'productController@edit_Product');

Route::post('/submit_edit_Product', 'productController@submit_edit_Product');