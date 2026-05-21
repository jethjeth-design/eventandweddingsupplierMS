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
        Schema::create('collaborations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_supplier_profile_id')
                ->constrained('supplier_profiles')
                ->cascadeOnDelete();

            $table->foreignId('conversation_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('title');

            $table->text('description')->nullable();

            $table->date('event_date')->nullable();

            $table->string('location')->nullable();

            $table->decimal('budget', 10, 2)->nullable();

            $table->enum('status', [
                'upcoming',
                'ongoing',
                'completed'
            ])->default('upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborations');
    }
};
