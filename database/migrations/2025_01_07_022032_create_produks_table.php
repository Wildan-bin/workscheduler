<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk
            $table->string('size'); // Ukuran produk
            $table->decimal('price', 10, 2); // Harga produk
            $table->text('description'); // Deskripsi produk
            $table->integer('stock')->nullable(); // Stok parfum (nullable)
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }

};
