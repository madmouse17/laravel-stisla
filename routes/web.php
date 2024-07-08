<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SiteSettingController;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth'])->group(function () {
    Route::middleware(['checkPassword'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard.index');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    });


    Route::get('/clear-session', ['as' => 'search', HomeController::class, 'sessionClear'])->name('clear.session');
    Route::get('password-default/', [HomeController::class, 'checkPassword'])->name('check.pd');

    Route::put('changePD/{user}', [HomeController::class, 'changePD'])->name('password.default');
    Route::put('change-password/{user}', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::put('change-email/{user}', [ProfileController::class, 'changeEmail'])->name('change.email');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin', 'checkPassword'])->prefix('admin')->group(function () {
    Route::resource('setting', SettingController::class);
    Route::resource('sitesetting', SiteSettingController::class);
    Route::resource('admin',AdminController::class);

});

require __DIR__ . '/auth.php';
