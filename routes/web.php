<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Text\TextMailController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Mail;
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
//



Route::get('/{guard}/verify-email', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');

Route::get('confirm', function () {
    return 'تحقق من البريد يا شاطر ';
})->name('con');















// dashboard admin routes :
Route::prefix('admin/')->name('admin.')->middleware(['auth:admin'])->group(function () {

    Route::prefix('texts/')->controller(TextMailController::class)->name('text.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    Route::prefix('permissions/')->controller(PermissionController::class)->name('permission.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    Route::prefix('roles/')->controller(RoleController::class)->name('role.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    Route::prefix('admins/')->controller(AdminController::class)->name('admin.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    Route::prefix('users/')->controller(UserController::class)->name('user.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });
});

// auth macro routes :
Route::authGuard('', 'web', 'web');
Route::authGuard('freelancer', 'freelancer', 'freelancer');
Route::authGuard('admin', 'admin', 'admin', ['register' => false]);
