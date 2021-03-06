<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Arr;
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



Route::get('/admin/login', [AdminController::class,'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class,'logout'])->name('admin.logout');
Route::post('/admin/login', [AdminController::class,'submitLogin'])->name('admin.submitLogin');

Route::middleware('authAdmin:webadmin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');

    // Comment
    Route::get('admin/comment', [CommentController::class,'index'])->name('admin.manage.comment');
    Route::get('admin/comment/delete/{id}', [CommentController::class,'delete_comment']);
    Route::get('admin/comment/{id}/active', [CommentController::class,'active']);
    Route::get('admin/comment/{id}/inactive', [CommentController::class,'inactive']);

    // Categories
    Route::resource('/admin/category', CategoryController::class);
    Route::get('admin/category/{id}/delete', [CategoryController::class,'destroy']);

    // Posts
    Route::resource('/admin/post', PostController::class);
    Route::get('admin/post/{id}/delete', [PostController::class,'destroy']);
    Route::get('admin/post/{id}/active', [PostController::class,'active']);
    Route::get('admin/post/{id}/inactive', [PostController::class,'inactive']);
    // users
    Route::get('admin/user', [AdminController::class,'users'])->name('admin.manage.users');
    Route::get('admin/user/delete/{id}', [AdminController::class,'delete_user'])->name('admin.manege.user.delete');
    //settings
    Route::get('/admin/setting', [SettingController::class,'index'])->name('admin.setting');
    Route::post('/admin/setting', [SettingController::class,'save_settings'])->name('admin.saveSetting');
});
Route::get('/', [HomeController::class, 'index']);


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/all-categories', [HomeController::class,'all_category']);
Route::get('/detail/{slug}/{id}', [HomeController::class,'detail'])->name('post_detail');

Route::middleware('auth')->group(function () {
    Route::post('/save-comment/{slug}/{id}', [HomeController::class,'save_comment']);
    Route::get('/category/{slug}/{id}', [HomeController::class,'category']);
    Route::get('save-post-form', [HomeController::class,'save_post_form']);
    Route::post('save-post-form', [HomeController::class,'save_post_data']);
});
