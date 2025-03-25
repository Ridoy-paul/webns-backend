<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AizUploadController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPagesCon;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\GlobalSettingsController;


/*
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registration-confirm', [AuthController::class, 'registration_confirm'])->name('registration.confirm');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login-confirm', [AuthController::class, 'loginConfirm'])->name('login.confirm');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/db-division', [AdminPagesCon::class, 'DbDivision']);

Route::get('/test-sms', [AdminPagesCon::class, 'testSms']);




Route::middleware('auth:sanctum')->group( function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    

    // Admin Route Start
    Route::group(['prefix' => 'admin'], function() {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        //admin dashboard report
        Route::get('/dashboard-visitors-report', [AdminController::class, 'visitorsReport'])->name('admin.dashboard.visitors.report');

        //admin dashboard report


        Route::get('/settings', [GlobalSettingsController::class, 'index'])->name('admin.settings');
        Route::post('/settings', [GlobalSettingsController::class, 'update'])->name('global.settings.update');

        Route::resource('countries', CountriesController::class)->except(['show', 'destroy', 'create']);
        Route::resource('division', DivisionController::class)->except(['show', 'destroy', 'create']);
        Route::resource('district', DistrictController::class)->except(['show', 'destroy', 'create']);
        Route::resource('pages', AdminPagesCon::class)->except(['show', 'destroy', 'create']);
        Route::resource('admin-categories', CategoriesController::class)->except(['show', 'destroy', 'create']);




        Route::resource('blogs', BlogController::class);
        
        
        
        // uploaded files
        Route::resource('/uploaded-files', AizUploadController::class);
        
        Route::controller(AizUploadController::class)->group(function () {
            Route::any('/uploaded-files/file-info', 'file_info')->name('uploaded-files.info');
            Route::get('/uploaded-files/destroy/{id}', 'destroy')->name('uploaded-files.destroy');
            Route::post('/bulk-uploaded-files-delete', 'bulk_uploaded_files_delete')->name('bulk-uploaded-files-delete');
            Route::get('/all-file', 'all_file');
        });

    });
    // Admin Route End

    // AIZ Uploader
    Route::controller(AizUploadController::class)->group(function () {
        Route::post('/aiz-uploader', 'show_uploader');
        Route::post('/aiz-uploader/upload', 'upload');
        Route::get('/aiz-uploader/get-uploaded-files', 'get_uploaded_files');
        Route::post('/aiz-uploader/get_file_bysuper_ids', 'get_preview_files');
        Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
    });


});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
*/


Route::middleware(['throttle:100,1'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/registration-confirm', [AuthController::class, 'registration_confirm'])->name('registration.confirm');
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login-confirm', [AuthController::class, 'loginConfirm'])->name('login.confirm');
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/db-division', [AdminPagesCon::class, 'DbDivision']);
    
    Route::get('/test-sms', [AdminPagesCon::class, 'testSms']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // Admin Route Start
        Route::group(['prefix' => 'admin'], function() {
            Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
            Route::get('/dashboard-visitors-report', [AdminController::class, 'visitorsReport'])->name('admin.dashboard.visitors.report');
            Route::get('/settings', [GlobalSettingsController::class, 'index'])->name('admin.settings');
            Route::post('/settings', [GlobalSettingsController::class, 'update'])->name('global.settings.update');
            Route::resource('countries', CountriesController::class)->except(['show', 'destroy', 'create']);
            Route::resource('division', DivisionController::class)->except(['show', 'destroy', 'create']);
            Route::resource('district', DistrictController::class)->except(['show', 'destroy', 'create']);
            Route::resource('pages', AdminPagesCon::class)->except(['show', 'destroy', 'create']);
            Route::resource('admin-categories', CategoriesController::class)->except(['show', 'destroy', 'create']);
            Route::resource('blogs', BlogController::class);
            Route::resource('/uploaded-files', AizUploadController::class);

            Route::controller(AizUploadController::class)->group(function () {
                Route::any('/uploaded-files/file-info', 'file_info')->name('uploaded-files.info');
                Route::get('/uploaded-files/destroy/{id}', 'destroy')->name('uploaded-files.destroy');
                Route::post('/bulk-uploaded-files-delete', 'bulk_uploaded_files_delete')->name('bulk-uploaded-files-delete');
                Route::get('/all-file', 'all_file');
            });
            
        });
        // Admin Route End
    });
    
    Route::controller(AizUploadController::class)->group(function () {
        Route::post('/aiz-uploader', 'show_uploader');
        Route::post('/aiz-uploader/upload', 'upload');
        Route::get('/aiz-uploader/get-uploaded-files', 'get_uploaded_files');
        Route::post('/aiz-uploader/get_file_bysuper_ids', 'get_preview_files');
        Route::get('/aiz-uploader/download/{id}', 'attachment_download')->name('download_attachment');
    });

    // Route::get('/admin', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard')->middleware(['auth', 'admin', 'prevent-back-history']);

});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
