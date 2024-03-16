<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('test-Auth', fn () => "OK")-> Middleware('auth');







Route ::get('tasks',[TaskController::class,'index'])->name('tasks.index');

Route ::get('tasks/create',[TaskController::class,'create'])->name('tasks.create');
Route ::post('tasks',[TaskController::class,'store'])->name('tasks.store');

Route ::get('/tasks/{id}',[TaskController::class,'show'])->name('tasks.show');

Route ::get('/tasks/{id}/edit',[TaskController::class,'edit'])->name('tasks.edit');
Route ::put('/tasks/{id}',[TaskController::class,'update'])->name('tasks.update');

Route ::delete('/tasks/{id}',[TaskController::class,'destroy']) ->name('tasks.destroy');


Route ::get('/users',[UserController::class,'index'])->name('users.index');

//if the route is Unkown
Route::fallback(fn () => 'Error Method not found');
