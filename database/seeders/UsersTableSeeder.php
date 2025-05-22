<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Official',
            'email' => 'admin@lawchicken.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@lawchicken.com',
            'password' => bcrypt('password'),
        ]);
    }
}
