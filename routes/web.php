<?php

use Illuminate\Support\Facades\Route;
 
//View::addNamespace('admin', app_path() . '/admin/views');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth']], function() {
    //Route::resource('roles', RoleController::class);
    //Route::resource('users', UserController::class);
    //Route::resource('products', ProductController::class);
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/***************************************MODULOS*****************************************************/
/*************************************MODULO VENTAS*************************************************/
Route::get('/ventas', [App\Http\Controllers\SaleController::class, 'index'])->name('home_sales');
Route::get('/ventas', [App\Http\Controllers\SaleController::class, 'autocompletebusinessName'])->name('sales.autocomplete.name');
/**************************************************************************************************/
Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear'); 
    dd("Cache Clear All");
});      
require __DIR__.'\modules\categories.php';

require __DIR__.'\auth_users.php';