<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/customers/data', [CustomerController::class, 'data'])->name('customers.data');
    Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/departments', [DepartmentController::class, 'data'])->name('departments.data');

    Route::get('/weather-widget', [WeatherController::class, 'index'])->name('weather');
    Route::get('/weather-history/{day?}', [WeatherController::class, 'show'])
        ->where('day', '[1-3]')
        ->name('weather-history');
});

require __DIR__ . '/auth.php';
