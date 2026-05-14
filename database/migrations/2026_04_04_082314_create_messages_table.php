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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('receiver_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('supplier_id')->nullable()->constrained('supplier_profiles')
            ->cascadeOnDelete();

            $table->text('message');
            $table->boolean('is_read')->default(false);

            $table->decimal('offer_price', 10, 2)->nullable();
            $table->enum('type', ['message', 'offer', 'counter', 'accept', 'reject'])
                ->default('message');

            $table->foreignId('package_id')->nullable()
                ->constrained()->nullOnDelete();

            $table->foreignId('event_id')->nullable()
                ->constrained()->nullOnDelete();

            $table->boolean('is_final_offer')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
