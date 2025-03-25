<?php

use App\Http\Controllers\Api\ApiBlogController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\MessCon;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\OthersCon;
use App\Http\Controllers\Api\RegistrationCon;
use App\Http\Controllers\Api\UserPropertiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MessBazarController;
use App\Http\Controllers\Api\MessMoneyCollectionController;
use App\Http\Controllers\Api\MessReportController;
use App\Http\Controllers\Api\MillController;
use Illuminate\Support\Facades\Broadcast;

// API Version 1:
Route::group(['prefix' => 'v1', 'middleware' => ['api', 'throttle:500,1']], function() {

    Route::prefix('auth')->group(function () {
        Route::post('/login', [RegistrationCon::class, 'login'])->middleware('web');
        
        Route::post('/registration-get-otp', [RegistrationCon::class, 'registration_get_otp']);
        Route::post('/verify-otp', [RegistrationCon::class, 'verify_otp']);
        Route::post('/register', [RegistrationCon::class, 'register'])->middleware('web');;

        Route::post('/forgot-password-get-otp', [RegistrationCon::class, 'forgot_password_get_otp']);
        Route::post('/forgot-password-confirm', [RegistrationCon::class, 'forgot_password_confirm']);
    });

    //Others
    Route::get('/get-division', [OthersCon::class, 'getDivision']);
    Route::get('/get-district', [OthersCon::class, 'getDistrict']);
    Route::get('/get-thana', [OthersCon::class, 'getThana']);
    Route::get('/get-sub-area', [OthersCon::class, 'getSubArea']);
    Route::get('/get-categories', [OthersCon::class, 'getCategories']);
    Route::get('/get-other-essentials', [OthersCon::class, 'getOtherEssentials']);

    //Blog News
    Route::get('/get-news-list', [ApiBlogController::class, 'getBlogList']);
    Route::get('/get-news-list-for-home-page', [ApiBlogController::class, 'getBlogListForHomePage']);
    Route::get('/get-news-item', [ApiBlogController::class, 'getNewsItem']);
    

    //verify settings code
    Route::get('/verify-settings-code', [OthersCon::class, 'verifySettingsCode']);

    //Home Property
    Route::get('/get-home-property', [OthersCon::class, 'getHomeProperty']);
    Route::get('/get-all-property', [OthersCon::class, 'getAllProperty']);
    Route::get('/get-all-property-page-location-info', [OthersCon::class, 'getPropertyPageLocationInfo']);
    

    // get-all-property-page-location-info

    Route::get('/get-home-property-details/{code}', [OthersCon::class, 'getPropertyDetails']);


    //Notifications
    Route::get('/user/counted-notification', [NotificationController::class, 'getUserCountedNotification']);
    

    Route::middleware('auth:sanctum')->group( function () {
        Route::get('/logout', [RegistrationCon::class, 'logout']);
        Route::get('/profile', [RegistrationCon::class, 'getProfile']);
        Route::post('/update-profile', [RegistrationCon::class, 'updateProfile']);
        Route::post('/auth-change-password', [RegistrationCon::class, 'authChangePassword']);
        
        //User Properties
        Route::controller(UserPropertiesController::class)->group(function () {
            Route::post('/add-property', 'addProperty');
            Route::get('/get-properties', 'getProperties');
            Route::post('/update-property', 'updateProperty');
            Route::get('/activate-or-deactivate-property', 'activeOrDeactivateProperty');
        });


        //Notifications
        Route::controller(NotificationController::class)->group(function () {
            Route::get('/user/notifications', 'getNotifications');
            Route::get('/user/see-all-notification', 'seeAllNotification');
        });
        // Route::get('/user/notifications', [NotificationController::class, 'getNotifications']);
        // Route::get('/user/see-all-notification', [NotificationController::class, 'seeAllNotification']);


        //Message Route
        Route::controller(MessageController::class)->group(function () {
            Route::post('/user/send-message', 'sendNewMessage');
            Route::post('/user/send-first-message', 'sendFirstMessage');
            Route::get('/user/get-message-group', 'getMessageGroup');
            Route::get('/user/get-message-chat/{code}', 'getMessageChat');
        });
        /*
        Route::post('/user/send-message', [MessageController::class, 'sendNewMessage']);
        Route::post('/user/send-first-message', [MessageController::class, 'sendFirstMessage']);
        Route::get('/user/get-message-group', [MessageController::class, 'getMessageGroup']);
        Route::get('/user/get-message-chat/{code}', [MessageController::class, 'getMessageChat']);
        */
        //Route::get('/user/see-all-notification', [NotificationController::class, 'seeAllNotification']);
        

        //mess system route
        Route::get('/mess-system/update-user-mess-status', [MessCon::class, 'update_user_mess_status']);
        Route::post('/mess-system/create-or-update-mess', [MessCon::class, 'create_or_update_mess']);
        Route::get('/mess-system/mess-list', [MessCon::class, 'mess_list']);
        Route::get('/mess-system/get-default-mess-code', [MessCon::class, 'getDefaultMessCode']);
        Route::get('/mess-system/set-default-mess/{mess_code}', [MessCon::class, 'setDefaultMess']);
        
        Route::get('/mess-system/mess-invitation', [MessCon::class, 'messInvitation']);
        Route::get('/mess-system/my-invitation-system', [MessCon::class, 'myInvitationSystem']);
        Route::get('/mess-system/user-update-status', [MessCon::class, 'userUpdateStatus']); // This is for manager or assistant manager who update member status.
        Route::get('/mess-system/join-mess-system', [MessCon::class, 'joinMessSystem']);
        
        //Mess Bazar
        Route::post('/mess-system/store-mill-bazar', [MessBazarController::class, 'storeMillBazar']);
        Route::get('/mess-system/mess-bazar-information', [MessBazarController::class, 'getMessBazarInfo']);
        Route::get('/mess-system/cancel-bazar', [MessBazarController::class, 'cancelBazarById']);
        Route::post('/mess-system/update-mill-bazar', [MessBazarController::class, 'updateMillBazar']);

        //Money Collection
        Route::post('/mess-system/store-money-collection', [MessMoneyCollectionController::class, 'storeMoneyCollection']);
        Route::get('/mess-system/get-money-collection', [MessMoneyCollectionController::class, 'getMessMoneyCollection']);
        Route::get('/mess-system/cancel-money-collection', [MessMoneyCollectionController::class, 'cancelMoneyCollection']);
        Route::post('/mess-system/update-money-collection', [MessMoneyCollectionController::class, 'updateMoneyCollection']);
        

        //Mill System
        Route::post('/mess-system/save-mill', [MillController::class, 'saveMillInfo']);
        Route::get('/mess-system/get-mill-info', [MillController::class, 'getMillInfo']);
        Route::get('/mess-system/get-mill-item', [MillController::class, 'getMillItem']);
        

        //Mess Report
        Route::get('/mess-system/mill-report-mini', [MessReportController::class, 'millReportMini']);
        Route::get('/mess-system/mess-report-full-mode', [MessReportController::class, 'messReportPage']);

        //Mess History
        Route::get('/mess-system/mess-history', [MessReportController::class, 'messHistory']);

        
        

        

        //https://medium.com/@moizali1011/mastering-firestore-crud-operations-in-laravel-a-comprehensive-guide-1e4f2f7bb28f
        // https://cloud.google.com/php/grpc

        
        

        // Client Start
        Route::middleware(['user'])->prefix('client')->group(function () {
            
        });

    });
    

    

});



// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Broadcast::routes(['middleware' => ['auth:sanctum']]);


// Route::post('/broadcasting/auth', function (Request $request) {
//     return Broadcast::auth($request);
// })->middleware('auth:sanctum');


