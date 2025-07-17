<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Models\Car;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingsController;

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
});

// Panel de administrador
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        // Aquí va la vista o controlador del dashboard de admin
        return view('dashboard.admin');
    })->name('admin.dashboard');
    
    // Gestión de usuarios
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.users.update');
    Route::patch('/admin/users/{id}/role', [UserController::class, 'changeRole'])->name('admin.users.role');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    
    // Configuración del sistema
    Route::get('/admin/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::put('/admin/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    Route::get('/admin/settings/data', [SettingsController::class, 'getSettings'])->name('admin.settings.data');
    
    // Otras rutas exclusivas de admin aquí
});

// Panel de ventas
Route::middleware(['auth', 'role:sales'])->group(function () {
    Route::get('/sales/dashboard', function () {
        // Aquí va la vista o controlador del dashboard de ventas
        return view('dashboard.sales');
    })->name('sales.dashboard');
    // Otras rutas exclusivas de sales aquí
});

// Panel de cliente
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/dashboard', function () {
        // Aquí va la vista o controlador del dashboard de cliente
        return view('dashboard.customer');
    })->name('customer.dashboard');
    // Otras rutas exclusivas de customer aquí
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

