<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::auth();

Route::group(['middleware' => 'is_guest'], function() {
      // Route for profile page
      Route::get('/profile', [HomeController::class, 'profile'])->name('profile-index');
      // Route for logout
      Route::get('/logout', [LoginController::class, 'logout']);
      // Route for create-blog page
      Route::get('/create-blog', [PostController::class, 'createblog'])->name('createblog');
      // Route for User Settings Page
      Route::get('/profile-settings', [UserController::class, 'settings'])->name('user.settings');
      
      // Routes for DASHBOARD pages
      Route::resource('/users', UserController::class, [
          'names' => [
            ],
      ]);
      Route::resource('/posts', PostController::class, [
          'names' => [
            ],
      ]);
});

// This return /homepage
Route::get('/', [HomeController::class, 'redirect']);

// Route for main homepage
Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');


// Route for post page
Route::get('/post/{slug}', [HomePageController::class, 'show'])->name('post-index');

Route::post('/comment/save', [HomePageController::class, 'store'])->name('comment-save');

Route::get('/info/{id}', [UserController::class, 'show'])->name('custom.show');
