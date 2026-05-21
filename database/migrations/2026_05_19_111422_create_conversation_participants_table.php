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
        Schema::create('conversation_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')
                  ->constrained()
                  ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | USER
            |--------------------------------------------------------------------------
            */

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | ROLE
            |--------------------------------------------------------------------------
            |
            | client
            | supplier
            | supplier_owner
            | member
            */

            $table->enum('role', [
                'admin',
                'client',
                'supplier',
                'collaborator',
                'member'
            ]);

            $table->timestamp('joined_at')->nullable();

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
        Schema::dropIfExists('conversation_participants');
    }
};
