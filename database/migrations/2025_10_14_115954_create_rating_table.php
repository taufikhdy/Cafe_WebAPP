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
        Schema::create('rating', function (Blueprint $table) {
            $table->id();

            $table->foreignId('menu_id')->constrained('menu')->onDelete('cascade');
            $table->foreignId('meja_id')->constrained('meja')->onDelete('cascade');
            $table->string('username');

            $table->tinyInteger('nilai');

            $table->text('ulasan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rating');
    }
};
