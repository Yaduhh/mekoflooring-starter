<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('image_produk');
            $table->string('slug_produk')->unique();
            $table->float('width');
            $table->float('thickness');
            $table->boolean('deleted_status')->default(false);  // Untuk soft delete
            $table->string('status');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};