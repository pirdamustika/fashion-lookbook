<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProductController;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Halaman Utama Lookbook Digital + Filter Kategori / Koleksi / Pencarian
Route::get('/', function (Request $request) {$query = Product::with('collection')->latest();

    if ($request->filled('category')) {
        $query->where('category',$request->category);
    }
    if ($request->filled('collection_id')) {
        $query->where('collection_id',$request->collection_id);
    }
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    $products = $query->get();$collections = Collection::all();

    return view('welcome', compact('products', 'collections'));
})->name('lookbook.index');

// Login & Logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Area Admin terproteksi Middleware Login
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('collections', CollectionController::class);
    Route::resource('products', ProductController::class);
});