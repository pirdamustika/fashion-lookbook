<?php

use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/lookbooks', function () {
    return response()->json([
        'status' => 'success',
        'data'   => Product::with('collection')->get(),
    ]);
});

Route::get('/collections', function () {
    return response()->json([
        'status' => 'success',
        'data'   => Collection::with('products')->get(),
    ]);
});