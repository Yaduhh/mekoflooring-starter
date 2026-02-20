<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        DB::table('products')
            ->where('product_type', 1)
            ->where('is_3d', true)
            ->update(['product_type' => 2]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to type 1
        DB::table('products')
            ->where('product_type', 2)
            ->update(['product_type' => 1]);
    }
};
