<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(WeightSeeder::class);

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'test@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
