<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id(); // Primary key (bigint auto_increment)
            $table->string('name'); // Nama toko
            $table->text('description')->nullable(); // Deskripsi (opsional)
            $table->string('owner_name'); // Nama pemilik toko
            $table->string('phone_number')->nullable(); // No HP
            $table->string('address'); // Alamat
            $table->string('image_path')->nullable(); // Path gambar toko (opsional)
            
            // Menambahkan kategori (kwt/ lainnya)
            $table->enum('category', ['kwt', 'lainnya'])->default('kwt'); // Kategori toko
            
            // Menambahkan tanggal dibentuk
            $table->date('established_date')->nullable(); // Tanggal dibentuk toko (opsional)
            
            // Menambahkan link toko
            $table->string('link')->nullable(); // Link toko (opsional)

            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shops');
    }
};
