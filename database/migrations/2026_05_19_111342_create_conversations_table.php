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
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            /*
            |--------------------------------------------------------------------------
            | conversation type
            |--------------------------------------------------------------------------
            |
            | client_supplier
            | supplier_collaboration
            | group
            */

            $table->enum('type', [
                'client_supplier',
                'supplier_collaboration',
                'client_admin',
                'admin_supplier',
                'group'
            ]);

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | BIDDING SUPPORT
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_bidding_chat')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Optional Collaboration Project
            |--------------------------------------------------------------------------
            */
            

            $table->foreignId('package_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('popular_package_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('collaboration_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
