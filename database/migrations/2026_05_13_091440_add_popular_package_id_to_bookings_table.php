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
        Schema::table('bookings', function (Blueprint $table) {
            $table->foreignId('popular_package_id')
                ->nullable()
                ->after('package_id')
                ->constrained('popular_packages')
                ->nullOnDelete();

            $table->string('booking_type')->nullable(); 
            // single | bundle
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropConstrainedForeignId('popular_package_id');
            $table->dropColumn('booking_type');
        });
    }
};
