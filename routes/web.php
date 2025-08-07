<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Text\TextMailController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Models\Admin;
use Illuminate\Http\Request;
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



Route::get('file' , function ()  {
 return view('file' );

});
Route::post('file' , function (Request $request)  {
    // ahmed
     $admin = Admin::query()->where('id' , '01k227ra6y23zr7xa26d95r2kq')->first();
     $nameImage = 'FreeLnaGo_' . time() .'_'. rand() . '_' . '.' .  $request->file('file')->getClientOriginalExtension();
     // stroage\app\public\admins\image
     $path = $request->file('file')->storeAs('admins', $nameImage , 'public');
     // database create
     // in images table : url ->  \admins\imageName
     // imageable_id -> 01k227ra6y23zr7xa26d95r2kq
     // imageable_type -> App\Models\Admin
     $admin->images()->create([
       'url' => $path ,
     ]);
     return 'تم تخزين الصورة '  ;
})->name('file');












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
