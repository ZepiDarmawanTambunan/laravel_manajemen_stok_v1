<?php

namespace Database\Seeders;

use App\Models\ProductsIn;
use App\Models\User;
use App\Models\Code;
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
            'kode_pegawai' => 'PG-001',
            'username' => 'Admin',
            'alamat' => 'Jambi',
            'no_telpon' => '089529512721',
            'password' => bcrypt('admin'),
            'remember_token' => Str::random(10),
        ]);
        User::create([
            'kode_pegawai' => 'PG-002',
            'username' => 'User',
            'alamat' => 'Jambi',
            'no_telpon' => '089529512728',
            'password' => bcrypt('user'),
            'remember_token' => Str::random(10),
        ]);
        Code::create([
            'code' => '1234',
        ]);
        // \App\Models\User::factory(10)->create();
        // ProductsIn::factory(20)->create();
    }
}
