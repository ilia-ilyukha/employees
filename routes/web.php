<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController; 
use App\Http\Controllers\EmployeeController; 
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
    return redirect('/employes');
});
Route::get('/employes', [EmployeeController::class, 'index'])->name('employes');
Route::get('/employes/{department_code}', [EmployeeController::class, 'department']);

Route::get('/import', [EmployeeController::class, 'import'])->name('import');
Route::post('/import', [EmployeeController::class, 'import'])->name('import');
