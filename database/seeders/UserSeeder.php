<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'family_id'         => random_int(1, 10),
                'name'              => 'Admin',
                'full_name'         => 'Admin User Name',
                'user_name'         => 'admin',
                'email'             => 'admin@as.com',
                'password'          => bcrypt('password'),
                'is_active'         => true,
                'is_read_terms'     => true,
                'email_verified_at' => now(),
                'remember_token'    => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        User::factory(20)->create();
    }
}
