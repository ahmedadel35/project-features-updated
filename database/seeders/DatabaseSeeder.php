<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
use App\Models\User;
use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Mail;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // for perfomance
        DB::beginTransaction();

        $admin = User::factory()->createQuietly([
            'name' => 'Ahmed Adel',
            'email' => 'user1@site.com',
        ]);

        $user = User::factory()->createQuietly([
            'name' => 'Ahmed Adel',
            'email' => 'user2@site.com',
         ]);

        $cats = Category::factory()
            ->has(
                Project::factory()
                    ->count(7)
                    ->has(Todo::factory()->count(random_int(3, 8)))
            )
            ->count(5)
            ->createQuietly([
                'user_id' => $admin->id,
            ]);

        User::factory(3)
            ->createQuietly()
            ->each(function (User $user) {
                // createQuietly categories for each user

                Category::factory()
                    ->count(random_int(1, 2))
                    ->has(
                        Project::factory()
                            ->count(random_int(1, 2))
                            ->has(Todo::factory()->count(1, 2))
                    )
                    ->createQuietly([
                        'user_id' => $user->id,
                    ]);
            });

        Project::limit(20)
            ->get()
            ->each->addToTeam($user);
        Category::factory()
            ->has(Project::factory()->count(20))
            ->createQuietly(['user_id' => $user->id]);

        DB::commit();
    }
}
