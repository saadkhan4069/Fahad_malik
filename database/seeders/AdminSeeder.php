<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin Company
        $adminCompany = Company::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin Company',
                'password' => Hash::make('admin123'),
                'phone' => '+92-300-1234567',
                'address' => 'Admin Office, Karachi, Pakistan',
                'is_active' => true,
            ]
        );

        // Create Admin User
        $adminUser = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('admin123'),
                'company_id' => $adminCompany->id,
            ]
        );

        echo "Admin user created successfully!\n";
        echo "Email: admin@admin.com\n";
        echo "Password: admin123\n";
        echo "Company ID: {$adminCompany->id}\n";
    }
}
