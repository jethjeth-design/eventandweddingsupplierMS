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
        Schema::create('supplier_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            // 🔗 relationship
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo')->nullable();        
            $table->string('business_name')->nullable();
            $table->string('tagline')->nullable();
            $table->string('phone')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->text('bio')->nullable(); 
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_profiles');
    }
};
