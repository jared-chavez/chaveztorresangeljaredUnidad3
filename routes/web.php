<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\CarController;
use App\Models\Car;

Route::view('/', 'home')->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cars

// API routes for cars
Route::prefix('api')->group(function () {
    Route::apiResource('cars', CarController::class);
});

// Web routes for car management
Route::get('/cars', function () {
    $cars = Car::all();
    return view('cars', compact('cars'));
})->name('cars.index');

Route::post('/cars', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
    ]);
    Car::create($validated);
    return redirect()->route('cars.index')->with('success', 'Auto agregado correctamente.');
})->name('cars.store');

Route::put('/cars/{car}', function (Illuminate\Http\Request $request, Car $car) {
    $validated = $request->validate([
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
    ]);
    $car->update($validated);
    return redirect()->route('cars.index')->with('success', 'Auto actualizado correctamente.');
})->name('cars.update');

Route::delete('/cars/{car}', function (Car $car) {
    $car->delete();
    return redirect()->route('cars.index')->with('success', 'Auto eliminado correctamente.');
})->name('cars.destroy');

// Additional required pages
Route::view('/sitemap', 'sitemap')->name('sitemap');
Route::view('/mailbox', 'mailbox')->name('mailbox');
Route::view('/help', 'help')->name('help');
Route::view('/contact', 'contact')->name('contact');
Route::view('/chat', 'chat')->name('chat');
Route::view('/password-recovery', 'password-recovery')->name('password.recovery');
Route::view('/search', 'search')->name('search');

