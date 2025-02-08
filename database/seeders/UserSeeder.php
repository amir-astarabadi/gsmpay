<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            "name" => "amir",
            "email" => "amirpourastarabadi@gmail.com",
            "password" => "password",
            "mobile" => "09302631762",
        ]);
        User::factory(50)->create();
    }
}
