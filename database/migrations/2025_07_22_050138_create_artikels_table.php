<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('artikels', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('konten');
            $table->enum('kategori', ['UMKM', 'Limbah', 'Maggot', 'Pemasaran']);
            $table->string('gambar')->nullable(); // Path gambar
            $table->date('diterbitkan_pada')->nullable(); // published_at
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artikels');
    }
};
