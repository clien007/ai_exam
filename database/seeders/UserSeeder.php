<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Array of users to seed
        $users = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'type' => 'Writer',
                'status' => 'Active',
                'email' => 'john.doe@example.com',
                'password' => Hash::make('password123'), // Use a secure password in production
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Smith',
                'type' => 'Writer',
                'status' => 'Active',
                'email' => 'jane.smith@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Alice',
                'lastname' => 'Johnson',
                'type' => 'Editor',
                'status' => 'Active',
                'email' => 'alice.johnson@example.com',
                'password' => Hash::make('password123'),
            ],
            [
                'firstname' => 'Bob',
                'lastname' => 'Brown',
                'type' => 'Editor',
                'status' => 'Active',
                'email' => 'bob.brown@example.com',
                'password' => Hash::make('password123'),
            ],
        ];

        // Insert users into the database
        DB::table('users')->insert($users);
    }
}
