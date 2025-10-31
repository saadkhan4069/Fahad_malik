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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->string('booking_number')->unique();
            $table->string('cn_number')->unique(); // Consignment Note Number
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->string('shipper_name');
            $table->string('shipper_email');
            $table->string('shipper_phone');
            $table->text('shipper_address');
            $table->string('consignee_name');
            $table->string('consignee_email');
            $table->string('consignee_phone');
            $table->text('consignee_address');
            $table->text('package_description');
            $table->decimal('package_value', 10, 2)->default(0);
            $table->decimal('weight', 8, 2);
            $table->json('dimensions'); // length, width, height
            $table->string('service_type')->default('standard');
            $table->datetime('pickup_date');
            $table->datetime('delivery_date')->nullable();
            $table->text('special_instructions')->nullable();
            $table->decimal('total_cost', 10, 2)->default(0);
            $table->datetime('booking_date')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
