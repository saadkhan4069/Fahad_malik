<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create sample companies
        Company::create([
            'name' => 'Tech Solutions Ltd',
            'email' => 'admin@techsolutions.com',
            'password' => Hash::make('password123'),
            'phone' => '+92-300-1234567',
            'address' => '123 Business Avenue, Gulberg',
            'city' => 'Lahore',
            'state' => 'Punjab',
            'zip_code' => '54000',
            'country' => 'Pakistan',
            'tax_id' => 'TAX-001-2024',
            'is_active' => true,
            'logo' => 'company/logos/adex-logo.png',
        ]);

        Company::create([
            'name' => 'E-Commerce Pro',
            'email' => 'info@ecommercepro.com',
            'password' => Hash::make('password123'),
            'phone' => '+92-300-7654321',
            'address' => '456 Commerce Street, DHA',
            'city' => 'Karachi',
            'state' => 'Sindh',
            'zip_code' => '75500',
            'country' => 'Pakistan',
            'tax_id' => 'TAX-002-2024',
            'is_active' => true,
        ]);

        Company::create([
            'name' => 'Global Trading Co',
            'email' => 'contact@globaltrading.com',
            'password' => Hash::make('password123'),
            'phone' => '+92-300-9876543',
            'address' => '789 Trade Center, Blue Area',
            'city' => 'Islamabad',
            'state' => 'Federal Capital',
            'zip_code' => '44000',
            'country' => 'Pakistan',
            'tax_id' => 'TAX-003-2024',
            'is_active' => true,
        ]);
    }
}
