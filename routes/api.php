<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Internal API Routes
 */

Route::get('/customers/data', [CustomerController::class, 'data'])->name('customers.data');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');

Route::get('/departments', [DepartmentController::class, 'data'])->name('departments.data');
