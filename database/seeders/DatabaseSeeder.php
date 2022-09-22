<?php

namespace Database\Seeders;

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
        \Artisan::call('db:seed --class=RolePermissionSeeder');
        \Artisan::call('db:seed --class=UserSeeder');

        // \App\Models\User::factory(10)->create();
    }
}
