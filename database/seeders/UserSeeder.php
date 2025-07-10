<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(int $count = 20): void
    {
        $positions = ['Developer', 'Designer', 'Manager', 'QA', 'DevOps'];
        $locations = ['Office', 'Remote', 'Hybrid', 'On-site'];

        for ($i = 1; $i < $count; $i++) {
            User::create([
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('test101'),
                'role' => 'Admin',
                'position' => fake()->randomElement($positions),
                'birthdate' => Carbon::parse(fake()->dateTimeBetween('-50 years', '-20 years'))->format('Y-m-d'),
                'location' => fake()->randomElement($locations),
                'contact' => '09' . rand(10, 99) . rand(1000000, 9999999),
            ]);
        }
    }
}
