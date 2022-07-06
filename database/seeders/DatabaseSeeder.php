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

        User::factory()->create([
            'name' => 'Ahmed Adel',
            'email' => 'admin@admin.com',
        ]);

        User::factory(10)->create()->each(function(User $user) {
            // create categories for each user
            
        });
    }
}
