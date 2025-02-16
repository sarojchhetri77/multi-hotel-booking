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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('room_number')->nullable();
            $table->integer('capacity');
            $table->integer('beds');
            $table->integer('no_of_adult');
            $table->integer('no_of_children');
            $table->string('bed_type')->nullable();
            $table->decimal('price_per_night', 10, 2);
            $table->boolean('available')->default(true);
            $table->boolean('has_wifi')->default(false);
            $table->boolean('has_air_conditioning')->default(false);
            $table->boolean('has_tv')->default(false);
            $table->boolean('has_bathroom')->default(false);
            $table->string('room_view')->nullable();
            $table->string('thumbnail')->nullable();
            $table->enum('status', config('constants.room_status'))->default(config('constants.room_status.available'));
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
