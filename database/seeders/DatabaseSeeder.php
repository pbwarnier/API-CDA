<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'lastname' => Str::random(10),
            'firstname' => Str::random(10),
            'phone' => Str::random(10),
            'id_role' => '1',
            'email' => 'a',
            'password' => Hash::make('a'),
        ]);
    }
}
