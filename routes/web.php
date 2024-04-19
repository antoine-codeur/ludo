<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommentController;

Route::get('/', [HomeController::class, 'index'])->name('home');
// Dashboard
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Admin CRUD routes (if needed)
Route::middleware('admin')->group(function () {
    Route::resource('posts', PostController::class)->only(['edit', 'update', 'destroy']);
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::resource('categories', CategoryController::class)->only(['edit', 'update', 'destroy']);
});

// Categories
Route::get('autocomplete-categories', [CategoryController::class, 'autocompleteCategories'])->name('autocomplete.categories');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::middleware('auth')->group(function () {
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
});

// Posts
Route::middleware('auth')->get('/my_posts', [PostController::class, 'myPosts'])->name('my_posts');
Route::resource('posts', PostController::class)->except(['index', 'show']);
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Comments
Route::middleware('auth')->group(function () {
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Admin CRUD routes (if needed)
Route::middleware('admin')->group(function () {
    Route::resource('posts', PostController::class)->only(['edit', 'update', 'destroy']);
    Route::resource('categories', CategoryController::class)->only(['edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
