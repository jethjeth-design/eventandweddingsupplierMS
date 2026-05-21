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
        Schema::create('bids', function (Blueprint $table) {

    $table->id();

    $table->foreignId('conversation_id')
        ->constrained()
        ->cascadeOnDelete();

    $table->foreignId('client_id')
        ->constrained('users')
        ->cascadeOnDelete();

    $table->foreignId('supplier_id')
        ->nullable()
        ->constrained('users')
        ->cascadeOnDelete();

    /*
    |--------------------------------------------------------------------------
    | BID TYPE
    |--------------------------------------------------------------------------
    */

    $table->enum('type', [
        'supplier',
        'package',
        'bundle_item'
    ]);

    /*
    |--------------------------------------------------------------------------
    | PACKAGE
    |--------------------------------------------------------------------------
    */

    $table->foreignId('package_id')
        ->nullable()
        ->constrained()
        ->cascadeOnDelete();

    /*
    |--------------------------------------------------------------------------
    | BUNDLE ITEM
    |--------------------------------------------------------------------------
    */

    $table->foreignId('popular_package_item_id')
        ->nullable()
        ->constrained()
        ->cascadeOnDelete();

    /*
    |--------------------------------------------------------------------------
    | PRICES
    |--------------------------------------------------------------------------
    */

    $table->decimal('base_price', 10, 2);

    $table->decimal('offer_price', 10, 2)
        ->nullable();

    $table->decimal('counter_price', 10, 2)
        ->nullable();

    /*
    |--------------------------------------------------------------------------
    | STATUS
    |--------------------------------------------------------------------------
    */

    $table->enum('status', [
        'pending',
        'accepted',
        'rejected',
        'countered'
    ])->default('pending');

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
