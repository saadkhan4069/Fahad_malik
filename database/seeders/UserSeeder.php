<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get companies
        $techSolutions = Company::where('name', 'Tech Solutions Ltd')->first();
        $ecommercePro = Company::where('name', 'E-Commerce Pro')->first();
        $globalTrading = Company::where('name', 'Global Trading Co')->first();

        // Create users for Tech Solutions Ltd
        if ($techSolutions) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@techsolutions.com',
                'password' => Hash::make('password123'),
                'company_id' => $techSolutions->id,
                'role' => 'admin',
                'is_active' => true,
            ]);

            User::create([
                'name' => 'Manager User',
                'email' => 'manager@techsolutions.com',
                'password' => Hash::make('password123'),
                'company_id' => $techSolutions->id,
                'role' => 'manager',
                'is_active' => true,
            ]);

            User::create([
                'name' => 'Regular User',
                'email' => 'user@techsolutions.com',
                'password' => Hash::make('password123'),
                'company_id' => $techSolutions->id,
                'role' => 'user',
                'is_active' => true,
            ]);
        }

        // Create users for E-Commerce Pro
        if ($ecommercePro) {
            User::create([
                'name' => 'E-Commerce Admin',
                'email' => 'admin@ecommercepro.com',
                'password' => Hash::make('password123'),
                'company_id' => $ecommercePro->id,
                'role' => 'admin',
                'is_active' => true,
            ]);

            User::create([
                'name' => 'E-Commerce Manager',
                'email' => 'manager@ecommercepro.com',
                'password' => Hash::make('password123'),
                'company_id' => $ecommercePro->id,
                'role' => 'manager',
                'is_active' => true,
            ]);
        }

        // Create users for Global Trading Co
        if ($globalTrading) {
            User::create([
                'name' => 'Global Admin',
                'email' => 'admin@globaltrading.com',
                'password' => Hash::make('password123'),
                'company_id' => $globalTrading->id,
                'role' => 'admin',
                'is_active' => true,
            ]);

            User::create([
                'name' => 'Global User',
                'email' => 'user@globaltrading.com',
                'password' => Hash::make('password123'),
                'company_id' => $globalTrading->id,
                'role' => 'user',
                'is_active' => true,
            ]);
        }
    }
}



