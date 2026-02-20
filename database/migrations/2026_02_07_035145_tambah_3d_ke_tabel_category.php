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
        Schema::table('categories', function (Blueprint $table) {
            // 3D Model support
            $table->string('model_3d')->nullable()->after('image_category');
            $table->string('model_2d')->nullable()->after('model_3d');
            $table->boolean('is_3d')->default(false)->after('model_2d');

            // Model metadata
            $table->json('model_settings')->nullable()->after('is_3d'); // untuk scale, rotation, dll
            $table->string('thumbnail_3d')->nullable()->after('model_settings'); // thumbnail untuk 3D model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'model_3d',
                'model_2d',
                'is_3d',
                'model_settings',
                'thumbnail_3d'
            ]);
        });
    }
};
