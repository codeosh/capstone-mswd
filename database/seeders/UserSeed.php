<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => "Derek Catigan",
            'email' => "derekcatigan@gmail.com",
            'password' => bcrypt('password'),
            'role' => "personnel",
        ]);
        $user = User::create([
            'name' => "Oshowa Catigan",
            'email' => "catiganderek@gmail.com",
            'password' => bcrypt('password'),
            'role' => "personnel",
        ]);

        $user = User::create([
            'name' => "Oshowa Code",
            'email' => "oshowacode1@gmail.com",
            'password' => bcrypt('password'),
            'role' => "admin",
        ]);
    }
}
