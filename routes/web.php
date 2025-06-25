<?php

use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoanCalculatorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'view'])->name('dashboard');

// Routes item CRUD
Route::post('/item', [ItemController::class, 'insert'])->name('item.store');
Route::put('/item/{id}', [ItemController::class, 'update'])->name('item.update');
Route::delete('/item/{id}', [ItemController::class, 'delete'])->name('item.destroy');

// Kalkulator Helper (sesuai unit test)
Route::get('/calculator', [CalculatorController::class, 'index'])->name('calculator');
Route::post('/calculate/discount', [CalculatorController::class, 'discount'])->name('calculate.discount');
Route::post('/calculate/add', [CalculatorController::class, 'add'])->name('calculate.add');
Route::post('/calculate/subtract', [CalculatorController::class, 'subtract'])->name('calculate.subtract');

// Loan Calculator
Route::get('/loan', [LoanCalculatorController::class, 'index']);
Route::post('/loan', [LoanCalculatorController::class, 'calculate']);
