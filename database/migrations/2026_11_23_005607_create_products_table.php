<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('collections')->onDelete('cascade');
            $table->string('name'); // contoh: Linen Oversized Shirt
            $table->string('category'); // Atasan, Bawahan, Outerwear
            $table->string('color'); // Putih, Hitam, Sage Green
            $table->string('material')->nullable(); // Katun Linen, Denim
            $table->string('size', 20); // S, M, L, XL
            $table->integer('price');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};