<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'email' => 'admin@mail.com',
                    'phone' => '01211111111',
                    'address' => 'No address needed',
                    'password' => bcrypt('123456789'),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'email_verified_at' => null,
                    'role_id' => 1,
                    'photo' => null,
                ],
                [
                    'name' => 'Sales Manager',
                    'email' => 'sales@mail.com',
                    'phone' => '01322222222',
                    'address' => 'No address needed',
                    'password' => bcrypt('987654321'),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'email_verified_at' => null,
                    'role_id' => 2,
                    'photo' => null,
                ],
                [
                    'name' => 'Purchase Manager',
                    'email' => 'purchase@mail.com',
                    'phone' => '01433333333',
                    'address' => 'No address needed',
                    'password' => bcrypt('147258369'),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'email_verified_at' => null,
                    'role_id' => 3,
                    'photo' => null,
                ],
            ]
        );
        User::factory()->count(2)->create();
    }
}
