<?php

use App\Http\Controllers\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\planController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/purchase', [planController::class, 'show'])->middleware(['auth'])->name('purchase');
Route::get('/users/delete/{id}', [users::class , 'deleteUser'])->middleware(['auth'])->name('delete');
Route::get('users/ban/{id}', [users::class , 'banUser'])->middleware(['auth'])->name('ban');
Route::post('/update/{id}', [users::class , 'update'])->middleware(['auth'])->name('update');
Route::get('/users', [users::class, 'showAll'])->middleware(['auth'])->name('users');
Route::get('users/{id}', [users::class, 'edit'])->middleware(['auth'])->name('edit');

require __DIR__.'/auth.php';
