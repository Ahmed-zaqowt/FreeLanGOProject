<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Freelancers\FreelancerController;
use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Projects\ProjectController as ProjectsProjectController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Text\TextMailController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Site\Projects\ProjectController as SiteProjectsProjectController;
use App\Http\Controllers\Web\Projects\ProjectController;
use App\Http\Controllers\Web\UserController as WebUserController;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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




/*
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
*/





// auth macro routes :
Route::authGuard('', 'web', 'web');
Route::authGuard('freelancer', 'freelancer', 'freelancer');
Route::authGuard('admin', 'admin', 'admin', ['register' => false]);


// dashboard admin routes :
Route::prefix('admin/')->name('admin.')->middleware(['auth:admin'])->group(function () {
    // 5 routes : index | getdata | store | update | delete
    Route::dataTableRoutesMacro('texts/', TextMailController::class, 'text');
    Route::dataTableRoutesMacro('permissions/', PermissionController::class, 'permission');
    Route::dataTableRoutesMacro('roles/', RoleController::class, 'role');
    Route::dataTableRoutesMacro('admins/', AdminController::class, 'admin');
    Route::dataTableRoutesMacro('users/', UserController::class, 'user');
    Route::dataTableRoutesMacro('freelancers/', FreelancerController::class, 'freelancer');
    Route::dataTableRoutesMacro('projects/', ProjectsProjectController::class, 'project');
    Route::dataTableRoutesMacro('skills/', ProjectsProjectController::class, 'skill');
});

//
Route::prefix('freelancer/')->name('freelancer.')->middleware(['auth:freelancer'])->group(function () {

    Route::controller(SiteProjectsProjectController::class)->group(function () {
        Route::get('projects', 'index')->name('index')->defaults('guard', 'freelancer');
        Route::get('project/{id}',  'projectDetails')->name('offer')->defaults('guard', 'freelancer');
        Route::post('project/proposal/store' , 'storeProposal')->name('project.proposal.store');
    });
});

// clinet
Route::name('web.')->middleware(['auth:web'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::prefix('profile')->controller(WebUserController::class)->name('profile.')->group(function () {
            Route::post('update', 'update')->name('update')->defaults('guard', 'web');
        });
        Route::dataTableRoutesMacro('projects/', ProjectController::class, 'project');
    });
    

    Route::controller(SiteProjectsProjectController::class)->group(function () {
        Route::get('projects', 'index')->name('index')->defaults('guard', 'web');
        Route::get('project/{id}',  'projectDetails')->name('offer')->defaults('guard', 'web');
    });
});

Route::get('rediract', function () {
    return redirect()->route('web.login');
})->name('rediract');

