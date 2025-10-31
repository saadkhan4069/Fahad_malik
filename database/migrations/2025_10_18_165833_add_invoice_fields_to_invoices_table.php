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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('billed_to')->nullable()->after('notes');
            $table->string('from_company')->nullable()->after('billed_to');
            $table->text('address')->nullable()->after('from_company');
            $table->string('contact')->nullable()->after('address');
            $table->json('services')->nullable()->after('contact');
            $table->string('bank_title')->nullable()->after('services');
            $table->string('account_number')->nullable()->after('bank_title');
            $table->string('iban')->nullable()->after('account_number');
            $table->string('bank_name')->nullable()->after('iban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn([
                'billed_to',
                'from_company', 
                'address',
                'contact',
                'services',
                'bank_title',
                'account_number',
                'iban',
                'bank_name'
            ]);
        });
    }
};