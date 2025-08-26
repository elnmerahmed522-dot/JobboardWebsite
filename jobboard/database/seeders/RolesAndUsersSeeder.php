<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesAndUsersSeeder extends Seeder
{
    public function run(): void
    {
       
$adminRole = Role::firstOrCreate(['name' => 'admin']);
$employerRole = Role::firstOrCreate(['name' => 'employer']);
$candidateRole = Role::firstOrCreate(['name' => 'candidate']);

       
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'phone' => '01000000000',
            'address' => 'Admin Address',
        ]);
        $admin->assignRole($adminRole);

        
        $employer = User::create([
            'name' => 'Employer User',
            'email' => 'employer@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'employer',
            'phone' => '01011111111',
            'address' => 'Employer Address',
        ]);
        $employer->assignRole($employerRole);

   
        $candidate = User::create([
            'name' => 'Candidate User',
            'email' => 'candidate@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'candidate',
            'phone' => '01022222222',
            'address' => 'Candidate Address',
        ]);
        $candidate->assignRole($candidateRole);
    }
}