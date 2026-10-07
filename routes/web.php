<?php

use App\Http\Controllers\EmployeeController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', [EmployeeController::class, 'index']);

// Form එක පෙන්වන Route එක
Route::get('/employees/create', [EmployeeController::class, 'create']);

// Form එකෙන් ඩේටා Submit කළාම ක්‍රියාත්මක වන Route එක
Route::post('/employees', [EmployeeController::class, 'store']);


Route::get('/employees/{id}', [EmployeeController::class, 'show']);
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit']);
Route::put('/employees/{id}', [EmployeeController::class, 'update']);
Route::delete('/employees/{id}', [EmployeeController::class, 'destroy']);