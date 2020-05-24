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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* Categories Routes Start */

Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::get('/createCategory', 'CategoriesController@create')->name('createCategory');
Route::post('/addCategory', 'CategoriesController@store')->name('addCategory');
Route::get('/editCategory/{id?}', 'CategoriesController@edit')->name('editCategory');
Route::post('/updateCategory', 'CategoriesController@update')->name('updateCategory');
Route::get('/deleteCategory/{id?}', 'CategoriesController@delete')->name('deleteCategory');

/* Categories Routes End */

/* Frontend Routes Start */
Route::get('/frontend', 'MenuController@index')->name('frontend');
/* Frontend Routes End */