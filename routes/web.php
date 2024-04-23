<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\PostController as PostController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Admin\TagController as TagController;
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
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function(){
    //ROTTA PER LA DASHBOARD IN CUI ATTERRA L'UTENTE DOPO AVER EFFETTUATO IL LOGIN
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/posts', PostController::class);
    Route::patch('/posts/edit_status/{post}', [PostController::class, 'edit_status'])->name('posts.post_edit_status');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
