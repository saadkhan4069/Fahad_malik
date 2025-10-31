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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('booking_id')->constrained()->onDelete('cascade');
            $table->string('tracking_number')->unique();
            $table->enum('status', ['pending', 'picked_up', 'in_transit', 'out_for_delivery', 'delivered', 'cancelled'])->default('pending');
            $table->text('origin_address');
            $table->text('destination_address');
            $table->string('origin_city');
            $table->string('destination_city');
            $table->string('origin_country');
            $table->string('destination_country');
            $table->decimal('weight', 8, 2);
            $table->json('dimensions'); // length, width, height
            $table->datetime('shipping_date');
            $table->datetime('estimated_delivery')->nullable();
            $table->datetime('actual_delivery')->nullable();
            $table->decimal('shipping_cost', 10, 2)->default(0);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
