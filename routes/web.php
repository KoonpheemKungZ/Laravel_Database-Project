<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
#use App\Models\User;
use Illuminate\Support\Facades\DB;



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

Route::get('/about', function (){
    return view('about');
});

Route::get('/aboutController',[AboutController::class,'showData']);

Route::get('/admin', function (){
    return view('admin.admin');
});

Route::get('/user/{name}', function($name){
    echo "<h1>Hello $name</h1>";
});
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = DB::table('users')->get();
    #$users = User::all();
    return view('dashboard',compact('users'));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/product/all',[ProductController::class,'index']) -> name('products');
    Route::post('/product/add',[ProductController::class,'store']) -> name('addproduct');
    Route::get('/product/edit/{id}',[ProductController::class,'edit']);
    Route::post('/product/update/{id}',[ProductController::class,'update']);
    Route::get('/product/softdelete/{id}',[ProductController::class,'softdelete']);

    Route::get('/service/all',[ServiceController::class,'index']) -> name('services');
    Route::post('/service/add',[ServiceController::class,'store']) -> name('addService');

    Route::get('/cart',[CartController::class,'cart']) -> name('cart');
    Route::get('/cart/add/{id}',[CartController::class,'tocart']);
    Route::get('/cart/softdelete/{id}',[CartController::class,'softdelete']);
});

 

