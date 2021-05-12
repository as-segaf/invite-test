<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'vos',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('secret123'),
            'is_admin' => 1,
        ]);
    }
}
