<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\MainUserController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function (){
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('admin.dashboard');

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    return view('user.index');
})->name('user.dashboard');

Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');

//All User Route
Route::get('user/logout', [MainUserController::class, 'logout'])->name('user.logout');
Route::middleware(['auth:sanctum,web', 'verified'])->get('user/profile', [MainUserController::class, 'UserProfile'])->name('user.profile');
Route::middleware(['auth:sanctum,web', 'verified'])->get('user/profile/edit', [MainUserController::class, 'UserProfileEdit'])->name('user.profile.edit');
Route::middleware(['auth:sanctum,web', 'verified'])->post('user/profile/store', [MainUserController::class, 'UserProfileStore'])->name('user.profile.store');
Route::middleware(['auth:sanctum,web', 'verified'])->get('user/password/view', [MainUserController::class, 'UserPasswordView'])->name('user.password.edit');
Route::middleware(['auth:sanctum,web', 'verified'])->post('user/password/update', [MainUserController::class, 'UserPasswordUpdate'])->name('user.password.update');
