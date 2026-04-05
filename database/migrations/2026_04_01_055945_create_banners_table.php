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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('hero_tag');
            $table->string('hero_title_1');
            $table->string('hero_title_2');
            $table->string('hero_subtitle');
            $table->string('slide_1');
            $table->string('slide_2');
            $table->string('slide_3');
            $table->string('slide_4');
            $table->string('slide_5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
