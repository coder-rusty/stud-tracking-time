<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoggedController;

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

Route::get('/home/create', function () {
    return view('admin.adduser');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/home/logs', function () {
//     return view('admin.logs');
// });


Route::get('/home', [HomeController::class, 'index'])->name('admin.index');

Route::delete('/home/{user}/delete', [UserController::class, 'delete'])->name('admin.delete');
Route::post('/home/create', [UserController::class, 'create'])->name('admin.create');

Route::post('/home/create', [LoggedController::class, 'create'])->name('logs.create');
Route::put('/home/{logs}/update', [LoggedController::class, 'update'])->name('logs.update');

Route::get('/home/logs', [LoggedController::class, 'index'])->name('admin.logs');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
