<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
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


Route::get('/admin/login', [AdminController::class,'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class,'submitLogin'])->name('admin.submitLogin');

Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');


// Categories
Route::resource('/admin/category', CategoryController::class);
Route::get('admin/category/{id}/delete', [CategoryController::class,'destroy']);

// Categories
Route::resource('/admin/post', PostController::class);
Route::get('admin/post/{id}/delete', [PostController::class,'destroy']);

//settings
Route::get('/admin/setting', [SettingController::class,'index'])->name('admin.setting');
Route::post('/admin/setting', [SettingController::class,'save_settings'])->name('admin.saveSetting');
