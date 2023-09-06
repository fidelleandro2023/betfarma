<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
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
/**************************************************************************************************/
Route::get('/clear-cache-all', function() {
    Artisan::call('cache:clear'); 
    dd("Cache Clear All");
});  
  
 
/********************** RUTAS DE categories *********************************************************/
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/list', [App\Http\Controllers\CategoryController::class, 'list'])->name('categories.list');
Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/update/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/categoryYearRegister/{year}', [App\Http\Controllers\CategoryController::class, 'categoryYearRegister'])->name('categories.YearRegister');
Route::get('/categories/categoryMonthRegister/{year}/{mes}', [App\Http\Controllers\CategoryController::class, 'categoryMonthRegister'])->name('categories.MonthRegister');
Route::get('/categories/categoryBetweenMonthRegister/{year}/{f_mes}/{l_mes}', [App\Http\Controllers\CategoryController::class, 'categoryBetweenMonthRegister'])->name('categories.BetweenMonthRegister');
/******************** FIN RUTAS DE categories ***************************************************/

/********************** RUTAS DE categories *********************************************************/
Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/list', [App\Http\Controllers\CategoryController::class, 'list'])->name('categories.list');
Route::get('/categories/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/update/{category}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('/categories/categoryYearRegister/{year}', [App\Http\Controllers\CategoryController::class, 'categoryYearRegister'])->name('categories.YearRegister');
Route::get('/categories/categoryMonthRegister/{year}/{mes}', [App\Http\Controllers\CategoryController::class, 'categoryMonthRegister'])->name('categories.MonthRegister');
Route::get('/categories/categoryBetweenMonthRegister/{year}/{f_mes}/{l_mes}', [App\Http\Controllers\CategoryController::class, 'categoryBetweenMonthRegister'])->name('categories.BetweenMonthRegister');
/******************** FIN RUTAS DE categories ***************************************************/
