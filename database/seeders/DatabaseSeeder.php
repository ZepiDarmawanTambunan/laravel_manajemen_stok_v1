<?php

namespace Database\Seeders;

use App\Models\ProductsIn;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Ardian Ilyas',
            'role' => 'Owner',
            'password' => bcrypt('guesswhat'),
            'remember_token' => Str::random(10),
        ]);
        // \App\Models\User::factory(10)->create();
        // ProductsIn::factory(20)->create();
    }
}
