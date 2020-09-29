<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
// Dựa vào thứ tự từ trên xuống dưới để chạy, những route có biến nên chạy ở dưới
Route::get('/', function () {
    return View::make('hello');
});

Route::get('/books','BookControlls@index')->name('books');  
Route::get('/books/{id}','BookControlls@info')->where('id', '[0-9]+');
Route::get('/books/{name}/{id}','BookControlls@chapter')->where('id', '[0-9]+');
// admin
Route::get('/admin','admin@index')->name('adminindex');
Route::post('/admin/delete', 'admin@deletebook');
Route::get('/admin/edit/{id}','admin@edit')->where('id', '[0-9]+');
Route::post('/admin/edit/{id}','admin@edit')->where('id', '[0-9]+');
Route::post('/admin/edit/info','admin@editinfo');
Route::post('/admin/edit/newchap','admin@newchap');
Route::post('/admin/edit/delete', 'admin@deletechap');
Route::get('/admin/newbook',function(){
    return Redirect()->route('adminindex');
});
Route::post('/admin/newbook','admin@newbook');

Route::get('/user/{name}/{password}', 'User@index')->where(['name' => '[a-zA-Z]+']);
