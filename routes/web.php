<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoryController;
use App\Models\Story;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'story', 'as' => 'story.'], function() {
   Route::get('/new', [StoryController::class, 'show'])->name('new');
   Route::post('/new', [StoryController::class, 'create'])->name('new');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'doLogin'])->name('login');

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::post('/story/{story:id}/approve', [AdminController::class, 'approve'])->name('approve');
        Route::post('/story/{story:id}/reject', [AdminController::class, 'reject'])->name('reject');
    });
});

Route::get('/login', function() {
    return redirect()->route('admin.login');
})->name('login');
