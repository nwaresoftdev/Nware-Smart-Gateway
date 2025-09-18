<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'test@example.com',
            'mobile' => '0123456789',
            'user_type_id' => 12,
            'fcm_token' => 'dsd87878',
        ]);
         User::factory(5)->create();
        $this->call([
            RolePermissionSeeder::class,
        ]);
    }
}
