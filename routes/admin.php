<?php

use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('users.index');
});

Route::resource('payment_methods', PaymentMethodController::class)->names('payment_methods');
Route::resource('users', UserController::class)->names('users');
