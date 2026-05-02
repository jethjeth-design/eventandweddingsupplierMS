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
        Schema::create('popular_packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Intimate Wedding Package
            $table->string('event_type'); // Wedding, Birthday
            $table->decimal('price', 10, 2)->nullable();

            $table->integer('guest_capacity')->nullable();
            $table->integer('duration_hours')->nullable();

            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('popular_packages');
    }
};
