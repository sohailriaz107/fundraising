<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\FundraisingController;
use Illuminate\Support\Facades\Route;


Route::get('/',[FundraisingController::class,'home'])->name('home');
Route::get('/about',[FundraisingController::class,'about'])->name('about');
Route::get('/blog',[FundraisingController::class,'blog'])->name('blog');
Route::get('/blog-single',[FundraisingController::class,'blog_single'])->name('blog-single');
Route::get('/contact',[FundraisingController::class,'contact'])->name('contact');
Route::get('/gallary',[FundraisingController::class,'gallary'])->name('gallary');
Route::get('/how/works',[FundraisingController::class,'How_Works'])->name('how-works');
Route::get('/donate',[FundraisingController::class,'donate'])->name('donate');


// admin nav
Route::get('/dashboard',[AdminController::class,'dashboard'])->name('dashboard');
Route::get('/nav',[AdminController::class,'navigation'])->name('nav');
Route::post('/nav/store',[AdminController::class,'NavStore'])->name('nav.store');
Route::get('/nav/edit/{id}',[AdminController::class,'NavEdit'])->name('nav.edit');
Route::get('/nav/delete/{id}',[AdminController::class,'NavDelete'])->name('nav.delete');
Route::put('/nav/update/{id}', [AdminController::class, 'NavUpdate'])->name('nav.update');

// Compagin
Route::get('/campaign',[CampaignController::class,'index'])->name('camp');
Route::post('/store',[CampaignController::class,'store'])->name('campaign.store');

