<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MechanicController;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    $totalMechanics = \App\Models\Mechanic::count();
    $totalCars = \App\Models\Car::count();
    $pendingCars = \App\Models\Car::where('status', 'pending')->count();
    $completedCars = \App\Models\Car::where('status', 'completed')->count();
    
    return view('dashboard', compact('totalMechanics', 'totalCars', 'pendingCars', 'completedCars'));
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rotas para Mecânicos
Route::resource('mechanics', MechanicController::class);

// Rotas para Carros
Route::resource('cars', CarController::class);
