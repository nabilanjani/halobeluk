<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shop_id')->constrained('shops')->onDelete('cascade'); // Relasi ke toko (KWT)
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable();
            $table->integer('harga')->nullable();
            $table->string('foto')->nullable(); // Path gambar
            $table->enum('kategori', ['umkm', 'maggot'])->default('umkm'); // Kategori produk
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
