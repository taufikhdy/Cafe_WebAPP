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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();

            $table->string('nama_menu');
            $table->text('deskripsi')->nullable();
            $table->integer('harga');
            // $table->integer('stok')->nullable()->default(0);
            $table->enum('status_stok', ['tersedia', 'tidak_tersedia'])->default('tersedia');
            $table->integer('penjualan')->nullable()->default(0);
            $table->string('foto')->nullable();
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
