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

            // 3D Model support
            if (!Schema::hasColumn('products', 'model_3d')) {
                $table->string('model_3d')->nullable()->after('mockup_image');
            }

            if (!Schema::hasColumn('products', 'model_2d')) {
                $table->string('model_2d')->nullable()->after('model_3d');
            }

            if (!Schema::hasColumn('products', 'is_3d')) {
                $table->boolean('is_3d')->default(false)->after('model_2d');
            }

            // Handle metadata
            if (!Schema::hasColumn('products', 'handle_settings')) {
                $table->json('handle_settings')->nullable()->after('is_3d');
            }

            if (!Schema::hasColumn('products', 'thumbnail_3d')) {
                $table->string('thumbnail_3d')->nullable()->after('handle_settings');
            }

            // Compatibility dengan door tertentu
            if (!Schema::hasColumn('products', 'compatible_doors')) {
                $table->json('compatible_doors')->nullable()->after('thumbnail_3d');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            if (Schema::hasColumn('products', 'compatible_doors')) {
                $table->dropColumn('compatible_doors');
            }

            if (Schema::hasColumn('products', 'thumbnail_3d')) {
                $table->dropColumn('thumbnail_3d');
            }

            if (Schema::hasColumn('products', 'handle_settings')) {
                $table->dropColumn('handle_settings');
            }

            if (Schema::hasColumn('products', 'is_3d')) {
                $table->dropColumn('is_3d');
            }

            if (Schema::hasColumn('products', 'model_2d')) {
                $table->dropColumn('model_2d');
            }

            if (Schema::hasColumn('products', 'model_3d')) {
                $table->dropColumn('model_3d');
            }
        });
    }
};

