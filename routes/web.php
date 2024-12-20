<?php

use App\Http\Controllers\LivroController;
use App\Http\Controllers\UserController;
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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    
Route::prefix('/biblioteca')->group(function() {
  
    Route::resource('usuario', UserController::class)->except(['show'])->middleware('permission');
    Route::resource('livro', LivroController::class)->except(['show']);
    Route::get('/livro/search', [LivroController::class, 'search'])->name('livro.search');
    Route::get('/usuario/search', [UserController::class, 'search'])->name('usuario.search');
    Route::post('/usuario/status/{userId}', [UserController::class, 'status'])->name('usuario.status')->middleware('permission');
    // Route::resource('book_loans', BookLoanController::class);
});
require __DIR__.'/auth.php';
