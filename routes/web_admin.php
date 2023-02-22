<?php

use App\Http\Controllers\Admin\AttemptController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IpAddressController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MagazineController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\PostPanelController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SalePanelController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserAgentController;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\VisitorPanelController;
use Illuminate\Support\Facades\Route;

Route::name('admin.')->group(function () {
    Route::get('/zurn41-21', [LoginController::class, 'create'])->middleware('guest')->name('login');
    Route::post('/zurn41-21', [LoginController::class, 'store'])->middleware('guest');
    Route::post('/zurn41-22', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/sale-panel', [SalePanelController::class, 'index'])->name('sale-panel');
    Route::get('/post-panel', [PostPanelController::class, 'index'])->name('post-panel');
    Route::get('/visitor-panel', [VisitorPanelController::class, 'index'])->name('visitor-panel');
    
    // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/{id}/show', [SaleController::class, 'show'])->name('sales.show')->where(['id' => '[0-9]+']);
    Route::post('/sales/api', [SaleController::class, 'api'])->name('sales.api');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}/show', [CustomerController::class, 'show'])->name('customers.show')->where(['id' => '[0-9]+']);
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('customers.edit')->where(['id' => '[0-9]+']);
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customers.update')->where(['id' => '[0-9]+']);
    Route::delete('/customers/{id}', [CustomerController::class, 'delete'])->name('customers.delete')->where(['id' => '[0-9]+']);
    Route::post('/customers/api', [CustomerController::class, 'api'])->name('customers.api');
    
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{id}', [ContactController::class, 'delete'])->name('contacts.delete')->where(['id' => '[0-9]+']);
    Route::post('/contacts/api', [ContactController::class, 'api'])->name('contacts.api');

    // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{id}/show', [PostController::class, 'show'])->name('posts.show')->where(['id' => '[0-9]+']);
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->where(['id' => '[0-9]+']);
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->where(['id' => '[0-9]+']);
    Route::delete('/posts/{id}', [PostController::class, 'delete'])->name('posts.delete')->where(['id' => '[0-9]+']);
    Route::post('/posts/api', [PostController::class, 'api'])->name('posts.api');
    Route::get('/posts/images/{id}', [PostController::class, 'image'])->name('posts.images.delete')->where(['id' => '[0-9]+']);

    Route::get('/magazines', [MagazineController::class, 'index'])->name('magazines.index');
    Route::get('/magazines/{id}/show', [MagazineController::class, 'show'])->name('magazines.show')->where(['id' => '[0-9]+']);
    Route::get('/magazines/create', [MagazineController::class, 'create'])->name('magazines.create');
    Route::post('/magazines', [MagazineController::class, 'store'])->name('magazines.store');
    Route::get('/magazines/{id}/edit', [MagazineController::class, 'edit'])->name('magazines.edit')->where(['id' => '[0-9]+']);
    Route::put('/magazines/{id}', [MagazineController::class, 'update'])->name('magazines.update')->where(['id' => '[0-9]+']);
    Route::delete('/magazines/{id}', [MagazineController::class, 'delete'])->name('magazines.delete')->where(['id' => '[0-9]+']);
    Route::post('/magazines/api', [MagazineController::class, 'api'])->name('magazines.api');
    Route::get('/magazines/{id}/download', [MagazineController::class, 'download'])->name('magazines.download')->where(['id' => '[0-9]+']);

    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}/show', [AuthorController::class, 'show'])->name('authors.show')->where(['id' => '[0-9]+']);
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
    Route::post('/authors', [AuthorController::class, 'store'])->name('authors.store');
    Route::get('/authors/{id}/edit', [AuthorController::class, 'edit'])->name('authors.edit')->where(['id' => '[0-9]+']);
    Route::put('/authors/{id}', [AuthorController::class, 'update'])->name('authors.update')->where(['id' => '[0-9]+']);
    Route::delete('/authors/{id}', [AuthorController::class, 'delete'])->name('authors.delete')->where(['id' => '[0-9]+']);
    Route::post('/authors/api', [AuthorController::class, 'api'])->name('authors.api');

    // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit')->where(['id' => '[0-9]+']);
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update')->where(['id' => '[0-9]+']);
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('categories.delete')->where(['id' => '[0-9]+']);

    Route::get('/plans', [PlanController::class, 'index'])->name('plans.index');
    Route::get('/plans/create', [PlanController::class, 'create'])->name('plans.create');
    Route::post('/plans', [PlanController::class, 'store'])->name('plans.store');
    Route::get('/plans/{id}/edit', [PlanController::class, 'edit'])->name('plans.edit')->where(['id' => '[0-9]+']);
    Route::put('/plans/{id}', [PlanController::class, 'update'])->name('plans.update')->where(['id' => '[0-9]+']);
    Route::delete('/plans/{id}', [PlanController::class, 'delete'])->name('plans.delete')->where(['id' => '[0-9]+']);

    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit')->where(['id' => '[0-9]+']);
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update')->where(['id' => '[0-9]+']);

    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

    Route::get('/ip-addresses', [IpAddressController::class, 'index'])->name('ip-addresses.index');
    Route::get('/ip-addresses/{id}/disabled', [IpAddressController::class, 'disabled'])->name('ip-addresses.disabled')->where(['id' => '[0-9]+']);
    Route::post('/ip-addresses/api', [IpAddressController::class, 'api'])->name('ip-addresses.api');

    Route::get('/user-agents', [UserAgentController::class, 'index'])->name('user-agents.index');
    Route::get('/user-agents/{id}/disabled', [UserAgentController::class, 'disabled'])->name('user-agents.disabled')->where(['id' => '[0-9]+']);
    Route::post('/user-agents/api', [UserAgentController::class, 'api'])->name('user-agents.api');

    Route::get('/visitors', [VisitorController::class, 'index'])->name('visitors.index');
    Route::post('/visitors/api', [VisitorController::class, 'api'])->name('visitors.api');

    Route::get('/attempts', [AttemptController::class, 'index'])->name('attempts.index');
    Route::post('/attempts/api', [AttemptController::class, 'api'])->name('attempts.api');

    // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // // //

    Route::get('/password', [PasswordController::class, 'edit'])->name('password.edit');
    Route::post('/password', [PasswordController::class, 'update'])->name('password.update');

});