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
        Schema::create('labels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained()->onDelete('cascade');
            $table->foreignId('shipment_id')->constrained()->onDelete('cascade');
            $table->string('label_number')->unique();
            $table->enum('label_type', ['shipping', 'return', 'custom'])->default('shipping');
            $table->enum('status', ['pending', 'generated', 'printed', 'cancelled'])->default('pending');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->datetime('generated_at')->nullable();
            $table->datetime('printed_at')->nullable();
            $table->string('tracking_code')->nullable();
            $table->text('barcode_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labels');
    }
};
