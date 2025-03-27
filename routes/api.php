<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

// API Version 1:
Route::group(['prefix' => 'v1', 'middleware' => ['api', 'throttle:200,1']], function() {

    Route::prefix('auth')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->middleware('web');
        
        Route::post('/register', [AuthController::class, 'register'])->middleware('web');
    });

    
    Route::middleware('auth:sanctum')->group( function () {
        Route::get('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [AuthController::class, 'getProfile']);
        Route::post('/update-profile', [AuthController::class, 'updateProfile']);
        Route::post('/auth-change-password', [AuthController::class, 'authChangePassword']);


        // Ticket Routes
        Route::controller(TicketController::class)->group(function () {
            Route::get('/ticket/get-status-category', 'getTicketStatusAndCategory');
            Route::post('/ticket/store-ticket', 'storeTicket');
            
        });
        
        

       

        

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


