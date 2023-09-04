<?php

use App\Http\Controllers\ConfirmationController;
use App\Http\Controllers\UserSettingsController;
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

// Роуты для подтверждения действия по email/sms/telegram
Route::middleware('auth')->prefix('confirmation')->group(function () {
    Route::get('/', [ConfirmationController::class, 'confirmationForm'])->name('confirmation.form');
    Route::get('confirm', [ConfirmationController::class, 'confirm'])->name('confirmation.confirm');
    Route::post('verify', [ConfirmationController::class, 'verify'])->name('confirmation.verify');
});

Route::middleware('auth')->group(function () {
    Route::prefix('user/settings')->group(function () {
        Route::get('/', [UserSettingsController::class, 'index'])
            ->name('user.settings.index');
        Route::put('update/notificationType', [UserSettingsController::class, 'updateNotificationType'])
            ->name('user.settings.update.notificationType');
        Route::get('update/notificationType', [UserSettingsController::class, 'updateNotificationTypeSubmit'])
            ->name('user.settings.update.notificationType.submit');
    });
});
