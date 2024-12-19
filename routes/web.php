<?php

use App\Http\Controllers\LivroController;
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
  
    // Route::resource('users', UserController::class);
    Route::resource('livro', LivroController::class)->except(['show']);
    Route::get('/livro/search', [LivroController::class, 'search'])->name('livro.search');
    // Route::resource('book_loans', BookLoanController::class);
});

require __DIR__.'/auth.php';
