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
        Schema::table('companies', function (Blueprint $table) {
            // Contact person details
            $table->string('contact_first_name')->nullable();
            $table->string('contact_last_name')->nullable();
            
            // Document numbers
            $table->string('cnic_no')->nullable();
            $table->string('ntn_no')->nullable();
            
            // Account details
            $table->string('account_activity')->nullable();
            $table->string('accounts_email')->nullable();
            $table->string('accounts_mobile')->nullable();
            
            // Additional company info
            $table->string('website')->nullable();
            $table->string('gst_no')->nullable();
            
            // File uploads
            $table->string('logo')->nullable();
            $table->string('cnic_front')->nullable();
            $table->string('cnic_back')->nullable();
            $table->string('ntn_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'contact_first_name',
                'contact_last_name',
                'cnic_no',
                'ntn_no',
                'account_activity',
                'accounts_email',
                'accounts_mobile',
                'website',
                'gst_no',
                'logo',
                'cnic_front',
                'cnic_back',
                'ntn_image'
            ]);
        });
    }
};
