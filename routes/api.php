<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Books;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// http://localhost/learn-restful/public/api/hello-world
Route::get('/hello-world', function(Request $request){
    return response()->json('This is my first Api project', 200);
});
Route::get('/checkDB',function(){
    var_dump(DB::connection()->getDatabaseName());
    die();
});
Route::get('/books',function(){
    return Books::all();
});
Route::get('/books/{id}',function(){
    return Books::where('id',$id)->get();
});