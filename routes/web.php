<?php

use App\Http\Controllers\LookbookFeatureController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

// Halaman utama lookbook
Route::get('/', [LookbookFeatureController::class, 'home'])->name('lookbook.home');
Route::get('/lookbook', [LookbookFeatureController::class, 'home'])->name('lookbook.index');

// Login & Logout Admin + alias route 'login' dan 'logout'
Route::get('/login', [LookbookFeatureController::class, 'showLogin'])->name('login');
Route::get('/admin/login', [LookbookFeatureController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [LookbookFeatureController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [LookbookFeatureController::class, 'logout'])->name('admin.logout');
Route::post('/logout', [LookbookFeatureController::class, 'logout'])->name('logout');

// Halaman Admin utama (wajib login)
Route::middleware('auth')->group(function () {
    if (class_exists(ProductController::class)) {
        Route::resource('/admin/products', ProductController::class)->names('admin.products');
    } else {
        Route::get('/admin/products', [LookbookFeatureController::class, 'adminIndex'])->name('admin.products.index');
    }

    // Alias aman untuk menu Koleksi di layouts/admin.blade.php agar tidak RouteNotFoundException
    if (!Route::has('admin.collections.index')) {
        Route::get('/admin/collections', [LookbookFeatureController::class, 'adminIndex'])->name('admin.collections.index');
    }

    Route::get('/admin/lookbook-features', [LookbookFeatureController::class, 'adminIndex'])->name('admin.features.index');
    Route::post('/admin/catalog', [LookbookFeatureController::class, 'storeProduct'])->name('admin.catalog.store');
    Route::delete('/admin/catalog/{id}', [LookbookFeatureController::class, 'destroyProduct'])->name('admin.catalog.destroy');
    Route::post('/admin/limited', [LookbookFeatureController::class, 'storeLimitedProduct'])->name('admin.limited.store');
    Route::post('/admin/products/{id}/toggle-limited', [LookbookFeatureController::class, 'toggleLimited'])->name('admin.features.toggle-limited');
    Route::post('/admin/models', [LookbookFeatureController::class, 'storeModel'])->name('admin.models.store');
    Route::delete('/admin/models/{id}', [LookbookFeatureController::class, 'destroyModel'])->name('admin.models.destroy');
});

// Fallback aman endpoint /api/lookbooks
Route::get('/api/lookbooks', function () {
    $products = Schema::hasTable('products') ? DB::table('products')->latest('id')->get() : collect();
    $models = Schema::hasTable('lookbook_models') ? DB::table('lookbook_models')->latest('id')->get() : collect();

    return response()->json([
        'products' => $products,
        'models' => $models,
    ]);
})->name('api.lookbooks.fallback');