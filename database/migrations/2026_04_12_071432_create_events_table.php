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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('event_name');
            $table->string('event_type'); // wedding, birthday, etc.

            $table->date('event_date');

            $table->time('event_time');

            // 💰 CORE OF YOUR SYSTEM
            $table->integer('budget');

            // 👥 event details
            $table->integer('guest_count')->nullable();

            // 📍 better structure than plain text later
            $table->string('venue')->nullable();

            // 🧠 recommendation system support
            $table->boolean('is_recommended')->default(false);
            $table->timestamp('recommended_at')->nullable();

            // 📌 event lifecycle
            $table->string('status')->default('pending');
            // pending | planning | confirmed | completed | cancelled

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
