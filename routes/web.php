<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\FundraisingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [UserController::class, 'showLoginForm'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

// 🔹 Register Routes
Route::get('/register', [UserController::class, 'showRegisterForm'])
    ->middleware('guest')
    ->name('register');
Route::post('/register', [UserController::class, 'register'])
    ->middleware('guest');


Route::middleware('auth')->group(function () {
    Route::get('/', [FundraisingController::class, 'home'])->name('home');
    Route::get('/about', [FundraisingController::class, 'about'])->name('about');
    Route::get('/blog', [FundraisingController::class, 'blog'])->name('blog');
    Route::get('/blog-single', [FundraisingController::class, 'blog_single'])->name('blog-single');
    Route::get('/contact', [FundraisingController::class, 'contact'])->name('contact');
    Route::get('/gallary', [FundraisingController::class, 'gallary'])->name('gallary');
    Route::get('/how/works', [FundraisingController::class, 'How_Works'])->name('how-works');
    Route::get('/donate', [FundraisingController::class, 'donate'])->name('donate');
});


// admin nav


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/register', [AdminController::class, 'RegisterForm'])->name('form');
    Route::post('/register', [AdminController::class, 'Register'])->name('register');
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
});

Route::middleware(['admin.auth'])->group(function(){
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/nav', [AdminController::class, 'navigation'])->name('nav');
Route::post('/nav/store', [AdminController::class, 'NavStore'])->name('nav.store');
Route::get('/nav/edit/{id}', [AdminController::class, 'NavEdit'])->name('nav.edit');
Route::get('/nav/delete/{id}', [AdminController::class, 'NavDelete'])->name('nav.delete');
Route::put('/nav/update/{id}', [AdminController::class, 'NavUpdate'])->name('nav.update');

// Compagin
Route::get('/campaign', [CampaignController::class, 'index'])->name('camp');
Route::post('/store', [CampaignController::class, 'store'])->name('campaign.store');
});