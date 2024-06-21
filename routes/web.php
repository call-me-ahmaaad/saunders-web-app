<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard1');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [EmployeeController::class, 'web_index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/employees/create', [EmployeeController::class, 'create'])->middleware(['auth', 'verified'])->name('create');
Route::post('/employees', [EmployeeController::class, 'store'])->middleware(['auth', 'verified'])->name('store');
Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

Route::get('/employees/list', [EmployeeController::class, 'list'])->name('employees.list');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
