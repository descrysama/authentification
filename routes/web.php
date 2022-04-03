<?php

use App\Http\Controllers\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\planController;
use App\Http\Controllers\attackController;
use App\Http\Controllers\methodsController;
use App\Http\Controllers\Controller;

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
    if (Auth::guard('web')->check()) {
        return redirect('/dashboard');   
    } else {
        return view('auth.login');
    }
});

Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('/profile', [users::class, 'showProfile'])->middleware(['auth'])->name('profile');
Route::post('/profile', [users::class, 'selfupdate'])->middleware(['auth'])->name('selfupdate');
Route::get('/purchase', [planController::class, 'showAll'])->middleware(['auth'])->name('purchase');
Route::get('/attack', [attackController::class, 'index'])->middleware(['auth'])->name('attack');
Route::post('/attack', [attackController::class, 'l4attack'])->middleware(['auth'])->name('l4attack');
Route::post('/attack/stop/{id}', [attackController::class, 'stopAttack'])->middleware(['auth']);
Route::get('/contact', [attackController::class, 'index'])->middleware(['auth'])->name('contact');


// ADMIN


Route::get('/admin', [users::class, 'showAll'])->middleware(['auth'])->name('admin');

Route::post('/plans/create', [planController::class, 'store'])->middleware(['auth'])->name('storeplan');
Route::get('/plans/create', [planController::class, 'create'])->middleware(['auth'])->name('createplan');
Route::get('/plans', [planController::class, 'listall'])->name('plans');
Route::get('/plans/{id}', [planController::class, 'edit'])->middleware(['auth'])->name('editplan');
Route::get('/plans/delete/{id}', [planController::class , 'deletePlan'])->middleware(['auth'])->name('deleteplan');
Route::post('/plans/update/{id}', [planController::class, 'update'])->middleware(['auth'])->name('updateplan');

Route::get('users/{id}', [users::class, 'edit'])->middleware(['auth'])->name('edit');
Route::get('/users/delete/{id}', [users::class , 'deleteUser'])->middleware(['auth'])->name('delete');
Route::get('users/ban/{id}', [users::class , 'banUser'])->middleware(['auth'])->name('ban');
Route::post('/update/{id}', [users::class , 'update'])->middleware(['auth'])->name('update');

Route::post('methods/create', [methodsController::class, 'store'])->middleware(['auth'])->name('storemethod');
Route::get('methods/create', [methodsController::class, 'create'])->middleware(['auth'])->name('createmethod');
Route::get('methods', [methodsController::class, 'index'])->middleware(['auth'])->name('methods');
Route::get('/methods/delete/{id}', [methodsController::class , 'deleteMethod'])->middleware(['auth'])->name('deletemethod');

require __DIR__.'/auth.php';
