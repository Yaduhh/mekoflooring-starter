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
        Schema::table('products', function (Blueprint $table) {
             // Menambahkan kolom mockup_image
            $table->string('mockup_image')->nullable(); // Kolom untuk gambar mockup

            // Menambahkan kolom length dengan tipe double
            $table->double('length')->nullable(); // Kolom untuk panjang produk
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
              // Menghapus kolom mockup_image
            $table->dropColumn('mockup_image');

            // Menghapus kolom length
            $table->dropColumn('length');
        });
    }
};
