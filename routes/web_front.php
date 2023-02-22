<?php

use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\LoginController;
use App\Http\Controllers\Front\MagazineController;
use App\Http\Controllers\Front\PageController;
use App\Http\Controllers\Front\PostController;
use App\Http\Controllers\Front\SaleController;
use App\Http\Controllers\Front\VerificationController;
use App\Http\Controllers\Front\SmsGatewayController;
use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam; // https://github.com/spatie/laravel-honeypot

Route::get('/verification', [VerificationController::class, 'create'])->middleware('guest:customer_web')->name('verification');
Route::post('/verification', [VerificationController::class, 'store'])->middleware('guest:customer_web', ProtectAgainstSpam::class);
Route::post('/login', [LoginController::class, 'store'])->middleware(['guest:customer_web', ProtectAgainstSpam::class])->name('login');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth:customer_web')->name('logout');

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/search/api', [HomeController::class, 'api'])->name('search.api');
Route::get('/language/{key}', [HomeController::class, 'language'])->name('language')->where(['key' => '[a-z]+']);

Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/category/{slug}/posts', [PostController::class, 'category'])->name('category')->where(['slug' => '[A-Za-z0-9-]+']);
Route::get('/author/{slug}/posts', [PostController::class, 'author'])->name('author')->where(['slug' => '[A-Za-z0-9-]+']);
Route::get('/post/{slug}', [PostController::class, 'show'])->name('post')->where(['slug' => '[A-Za-z0-9-]+']);

Route::get('/magazines', [MagazineController::class, 'index'])->name('magazines');
Route::get('/magazine/{slug}/download', [MagazineController::class, 'download'])->name('download')->where(['slug' => '[A-Za-z0-9-]+']);

Route::get('/plans', [SaleController::class, 'index'])->name('sales');
Route::get('/plan', [SaleController::class, 'create'])->name('sale.create');
Route::post('/plan', [SaleController::class, 'store'])->middleware(ProtectAgainstSpam::class)->name('sale.store');

Route::get('/plan/check/{id}', [SaleController::class, 'check']);
Route::get('/contact', [ContactController::class, 'create'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware(ProtectAgainstSpam::class);

Route::get('/about-us', [PageController::class, 'about'])->name('about-us');

// Route::get('/ok', [SmsGatewayController::class, 'test']);
