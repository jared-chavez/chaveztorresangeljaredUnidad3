<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Models\Car;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PasswordResetController;

Route::view('/', 'home')->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Car Management Routes

// API routes for cars (AJAX/React endpoints)
Route::prefix('api')->group(function () {
    // Public API endpoints
    Route::post('/login', [AuthController::class, 'apiLogin']);
    Route::post('/register', [AuthController::class, 'apiRegister']);

    // Protected API endpoints
    Route::middleware(['auth'])->group(function () {
        Route::apiResource('cars', CarController::class);
        Route::post('/logout', [AuthController::class, 'apiLogout']);
    });
});

// Vehiculos (Cars) routes only for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/cars', function () {
        $cars = Car::all();
        return view('cars', compact('cars'));
    })->name('cars.index');
    Route::get('/cars-ajax', function () {
        return view('cars-ajax');
    })->name('cars.ajax');
    Route::get('/cars-react', function () {
        return view('cars-react');
    })->name('cars.react');
});

// Additional required pages
Route::view('/sitemap', 'sitemap')->name('sitemap');
Route::view('/mailbox', 'mailbox')->name('mailbox');
Route::view('/help', 'help')->name('help');
Route::view('/contact', 'contact')->name('contact');
Route::view('/chat', 'chat')->name('chat');
Route::view('/password-recovery', 'password-recovery')->name('password.recovery');
Route::view('/search', 'search')->name('search');
Route::view('/services', 'services')->name('services');
Route::view('/financiamiento', 'financiamiento')->name('financiamiento');

Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');
Route::post('/password/email', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::post('/password/reset', [PasswordResetController::class, 'reset'])->name('password.update');

// Password reset link (GET)
Route::get('/password/reset/{token}', function ($token) {
    $email = request('email');
    return view('password-recovery', compact('token', 'email'));
})->name('password.reset');

