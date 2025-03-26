<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\HomeController;



Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    
});

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});
