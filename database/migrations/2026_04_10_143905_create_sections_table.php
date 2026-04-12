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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_title')->nullable();
            $table->string('section_subtitle')->nullable();
            $table->string('feature_title')->nullable();
            $table->string('feature_desc')->nullable();
            $table->string('feature_title2')->nullable();
            $table->string('feature_desc2')->nullable();
            $table->string('feature_title3')->nullable();
            $table->string('feature_desc3')->nullable();
            $table->string('feature_title4')->nullable();  
            $table->string('feature_desc4')->nullable();
            $table->string('feature_title5')->nullable();
            $table->string('feature_desc5')->nullable();
            $table->string('feature_title6')->nullable();
            $table->string('feature_desc6')->nullable(); 
            $table->string('feature_title7')->nullable();
            $table->string('feature_desc7')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
