<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\ScheduledEmailController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/mail-test', function () {
    Mail::raw('Ini email test.', function ($message) {
        $message->to('mevdreizel@gmail.com')
                ->subject('Test Email');
    });

    return 'Email test terkirim (cek inbox / Mailtrap).';
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/recipients', [RecipientController::class, 'index'])->name('recipients.index');
    Route::post('/recipients', [RecipientController::class, 'store'])->name('recipients.store');
    Route::get('/scheduled-emails', [ScheduledEmailController::class, 'index'])->name('scheduled.index');
    Route::post('/scheduled-emails', [ScheduledEmailController::class, 'store'])->name('scheduled.store');
});

require __DIR__.'/auth.php';
