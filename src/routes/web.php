<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;

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


Route::get('/', [ContactController::class, 'index'])->name('input');
Route::post('/contacts/confirm', [ContactController::class, 'confirm'])
    ->name('contacts.confirm');
Route::post('/contacts', [ContactController::class, 'store'])
    ->name('contacts.store');
Route::get('/thanks', function () {
    return view('contacts.thanks');
})->name('thanks');
Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.contacts.index');
});
Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register');
Route::post('/login',    [AdminAuthController::class, 'login'])->name('admin.login');
Route::post('/logout',   [AdminAuthController::class, 'logout'])->name('admin.logout');
// 画像一覧ページ（AdminControllerで管理）
Route::middleware('auth')->group(
    function () {
        Route::get('/admin/images', [App\Http\Controllers\AdminController::class, 'images'])
            ->name('admin.images.index');
    }
);
