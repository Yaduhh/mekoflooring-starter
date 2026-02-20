<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'model_3d')) {
                $table->dropColumn(['model_3d', 'model_2d', 'is_3d', 'model_settings', 'thumbnail_3d']);
            }

            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')->nullable()->after('image_category');
            }

            if (!Schema::hasColumn('categories', 'product_count')) {
                $table->integer('product_count')->default(0)->after('description');
            }
        });

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'handle_settings')) {
                $table->dropColumn('handle_settings');
            }
            if (Schema::hasColumn('products', 'compatible_doors')) {
                $table->dropColumn('compatible_doors');
            }

            if (!Schema::hasColumn('products', 'door_base_name')) {
                $table->string('door_base_name')->nullable()->after('nama');
            }

            if (!Schema::hasColumn('products', 'handle_name')) {
                $table->string('handle_name')->nullable()->after('door_base_name');
            }

            if (!Schema::hasColumn('products', 'handle_code')) {
                $table->string('handle_code')->nullable()->after('handle_name');
            }

            if (Schema::hasColumn('products', 'model_3d') && !Schema::hasColumn('products', 'complete_model_3d')) {
                $table->renameColumn('model_3d', 'complete_model_3d');
            }

            if (Schema::hasColumn('products', 'model_2d') && !Schema::hasColumn('products', 'complete_model_2d')) {
                $table->renameColumn('model_2d', 'complete_model_2d');
            }

            if (!Schema::hasColumn('products', 'catalog_image')) {
                $table->string('catalog_image')->nullable()->after('image_produk');
            }

            if (!Schema::hasColumn('products', 'viewer_thumbnail')) {
                $table->string('viewer_thumbnail')->nullable()->after('thumbnail_3d');
            }

            if (!Schema::hasColumn('products', 'model_file_size')) {
                $table->integer('model_file_size')->nullable();
            }

            if (!Schema::hasColumn('products', 'model_complexity')) {
                $table->enum('model_complexity', ['low', 'medium', 'high'])->default('medium');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->string('model_3d')->nullable();
            $table->string('model_2d')->nullable();
            $table->boolean('is_3d')->default(false);
            $table->json('model_settings')->nullable();
            $table->string('thumbnail_3d')->nullable();
            $table->dropColumn(['description', 'product_count']);
        });

        Schema::table('products', function (Blueprint $table) {
            $table->json('handle_settings')->nullable();
            $table->json('compatible_doors')->nullable();

            $table->dropColumn([
                'door_base_name',
                'handle_name',
                'handle_code',
                'catalog_image',
                'viewer_thumbnail',
                'model_file_size',
                'model_complexity'
            ]);

            if (Schema::hasColumn('products', 'complete_model_3d')) {
                $table->renameColumn('complete_model_3d', 'model_3d');
            }
            if (Schema::hasColumn('products', 'complete_model_2d')) {
                $table->renameColumn('complete_model_2d', 'model_2d');
            }
        });
    }
};
