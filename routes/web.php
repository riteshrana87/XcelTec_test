<?php

use Illuminate\Support\Facades\Route;
use App\Models\CmsPage;
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

// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/', 'Front\HomeController@index')->name('home');

Route::get('/', [App\Http\Controllers\Auth\AdminLoginController::class,'login'])->name('login');
Route::post('admin/login', [App\Http\Controllers\Auth\AdminLoginController::class,'adminLogin'])->name('adminLogin');


 Auth::routes();

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
    //Client Management
    Route::get('/dashboard', [App\Http\Controllers\Admin\EmployeesController::class, 'index'])->name('dashboard');

    Route::get('/employees_management', [App\Http\Controllers\Admin\EmployeesController::class, 'index'])->name('employees_management');
    Route::get('/add_employees', [App\Http\Controllers\Admin\EmployeesController::class, 'create'])->name('add_employees');
    Route::post('/store_employees', [App\Http\Controllers\Admin\EmployeesController::class, 'store'])->name('store_employees');
    Route::get('/edit_employees/{id}', [App\Http\Controllers\Admin\EmployeesController::class, 'edit'])->name('edit_employees');
    Route::post('/update_employees/{id}', [App\Http\Controllers\Admin\EmployeesController::class, 'update'])->name('update_employees');
    Route::get('/delete_employees/{id}', [App\Http\Controllers\Admin\EmployeesController::class, 'destroy'])->name('delete_employees');
    Route::get('/profile', [App\Http\Controllers\Admin\EmployeesController::class, 'profile'])->name('profile');
    Route::post('/profile-update/{id}', [App\Http\Controllers\Admin\EmployeesController::class, 'profileUpdate'])->name('profile-update');
    Route::post('logout', [App\Http\Controllers\Auth\AdminLoginController::class,'logout'])->name('logout');

    
});





























































