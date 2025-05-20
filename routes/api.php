<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    // Customer Routes
    Route::get('/get-customers', [CustomerController::class, 'getCustomers']);
    Route::post('/add-customer', [CustomerController::class, 'addCustomer']);
    Route::put('/edit-customer/{id}', [CustomerController::class, 'editCustomer']);
    Route::delete('/delete-customer/{id}', [CustomerController::class, 'deleteCustomer']);

    // User Routes
    Route::get('/get-users', [UserController::class, 'getUsers']);
    Route::post('/add-user', [UserController::class, 'addUser']);
    Route::put('/edit-user/{id}', [UserController::class, 'editUser']);
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

    // Role Routes
    Route::get('/get-roles', [RoleController::class, 'getRoles']);
    Route::post('/add-role', [RoleController::class, 'addRole']);
    Route::put('/edit-role/{id}', [RoleController::class, 'editRole']);
    Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);

    // Status Routes
    Route::get('/get-statuses', [StatusController::class, 'getStatuses']);
    Route::post('/add-status', [StatusController::class, 'addStatus']);
    Route::put('/edit-status/{id}', [StatusController::class, 'editStatus']);
    Route::delete('/delete-status/{id}', [StatusController::class, 'deleteStatus']);

    // Product Routes
    Route::get('/get-products', [ProductController::class, 'getProducts']);
    Route::post('/add-product', [ProductController::class, 'addProduct']);
    Route::put('/edit-product/{id}', [ProductController::class, 'editProduct']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct']);

    // Transaction Routes
    Route::get('/get-transactions', [TransactionController::class, 'getTransactions']);
    Route::post('/add-transaction', [TransactionController::class, 'addTransaction']);
    Route::delete('/delete-transaction/{id}', [TransactionController::class, 'deleteTransaction']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);
});
