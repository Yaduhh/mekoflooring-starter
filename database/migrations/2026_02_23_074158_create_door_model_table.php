<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('door_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('door_type_id')->constrained('door_types')->onDelete('cascade');
            $table->string('door_base_name');
            $table->string('handle_name');
            $table->string('handle_code', 20);
            $table->string('slug')->unique();
            $table->string('catalog_image');
            $table->string('viewer_thumbnail')->nullable();
            $table->string('model_file', 255); // path to .glb/.gltf
            $table->bigInteger('model_file_size')->nullable();
            $table->enum('model_complexity', ['low', 'medium', 'high'])->default('medium');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('deleted_status')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('door_models');
    }
};
