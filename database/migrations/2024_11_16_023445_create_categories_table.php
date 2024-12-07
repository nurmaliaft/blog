<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel 'categories'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();  // Kolom ID, auto-increment
            $table->string('name');  // Kolom nama kategori
            $table->timestamps();  // Kolom timestamps: created_at dan updated_at
        });
    }

    /**
     * Membalikkan migrasi, menghapus tabel 'categories'.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};