<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembershipPlanController;

Route::get('/', [MembershipPlanController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::resource('plans', MembershipPlanController::class);
});

