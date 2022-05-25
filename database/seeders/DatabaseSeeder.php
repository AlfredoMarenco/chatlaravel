<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::create([
            'name' => 'Alfredo Gonzalez',
            'email' => 'dev@agenciavandu.com',
            'password' => bcrypt('marencos6359:D')
        ]);

        \App\Models\User::factory(10)->create();
    }
}
