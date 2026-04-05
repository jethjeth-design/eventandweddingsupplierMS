<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'name' => 'System Admin',
            'email' => 'admin@system.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin'
        ]);
    }
 
}
