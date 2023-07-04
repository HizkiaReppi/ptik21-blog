<?php

use App\Http\Controllers\DashboardCategoryController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');
    Route::get('/dashboard/posts/check-slug', [DashboardPostController::class, 'checkSlug'])->name('dashboard.posts.checkSlug');
    Route::resource('/dashboard/posts', DashboardPostController::class)->names('dashboard.posts');
    Route::get('/dashboard/categories/check-slug', [DashboardCategoryController::class, 'checkSlug'])->name('dashboard.categories.checkSlug');
    Route::resource('/dashboard/categories', DashboardCategoryController::class)->names('dashboard.categories');
    Route::resource('/dashboard/users', DashboardUserController::class)->names('dashboard.users');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
