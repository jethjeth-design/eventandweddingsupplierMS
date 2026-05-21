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
        Schema::create('supplier_team_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_profile_id')
                  ->constrained('supplier_profiles')
                  ->cascadeOnDelete();

            $table->string('name');

            $table->string('role');

            $table->string('email')->nullable();

            $table->string('phone')->nullable();

            $table->text('bio')->nullable();

            $table->string('photo')->nullable();

            $table->boolean('is_active')
                  ->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_team_members');
    }
};
