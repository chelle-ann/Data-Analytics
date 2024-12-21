<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/logout', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/fetch-dashboard-data', [DashboardController::class, 'fetchData'])->name('fetch.dashboard.data');


Route::get('/sales/filter/month/{month}', [SalesController::class, 'filterByMonth'])->name('filterByMonth');
Route::get('/sales/filter/model/{model}', [SalesController::class, 'filterByModel'])->name('filterByModel');
Route::get('/sales/filter/color/{color}', [SalesController::class, 'filterByColor'])->name('filterByColor');
Route::get('/sales/filter/dealer/{dealerId}', [SalesController::class, 'filterByDealer'])->name('filterByDealer');

Route::get('/sales/monthly', [SalesController::class, 'getMonthlySales'])->name('getMonthlySales');
Route::get('/sales/by-model', [SalesController::class, 'getSalesByModel'])->name('getSalesByModel');
Route::get('/sales/by-dealer', [SalesController::class, 'getSalesByDealer'])->name('getSalesByDealer');

Route::get('/cars', [SalesController::class, 'getAllCars'])->name('getAllCars');
Route::get('/customers', [SalesController::class, 'getAllCustomers'])->name('getAllCustomers');
Route::get('/dealers', [SalesController::class, 'getAllDealers'])->name('getAllDealers');

//CONTROLLERS
Route::get('/car-sales-data', [CarSalesController::class, 'getCarSalesData']);
Route::get('/car-color-data', [CarColorController::class, 'getColorSalesData']);
Route::get('/car-sales-bar-data', [CarSalesBarController::class, 'getSalesByModel']);

//SALES CONTROLLERS
Route::get('/fetch-sales-data', [SalesController::class, 'fetchSalesData'])->name('fetchSalesData');
Route::get('/fetch-filters', [SalesController::class, 'fetchFilters'])->name('fetchFilters');


require __DIR__.'/auth.php';
