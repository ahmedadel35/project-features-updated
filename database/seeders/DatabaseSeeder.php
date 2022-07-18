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

        $ahmed = User::factory()->createQuietly([
            'name' => 'Ahmed Adel',
            'email' => 'user1@site.com',
            'avatar' => '/users/admin.jpeg',
        ]);

        $mahmoud = User::factory()->createQuietly([
            'name' => 'Mahmoud Adel',
            'email' => 'user2@site.com',
            'avatar' => '/users/4.png',
        ]);

        $cats = Category::factory()
            ->has(
                Project::factory()
                    ->count(random_int(4, 9))
                    ->has(Todo::factory()->count(random_int(3, 8)))
            )
            ->count(5)
            ->createQuietly([
                'user_id' => $ahmed->id,
            ]);

        User::factory(3)
            ->createQuietly()
            ->each(function (User $user) {
                // create categories for each user
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

        Project::limit(10)
            ->get()
            ->each->addToTeam($mahmoud);
        Category::factory()
            ->has(Project::factory()->count(19))
            ->createQuietly(['user_id' => $mahmoud->id]);

        Project::inRandomOrder()
            ->limit(15)
            ->get()
            ->each(function (Project $project) {
                $project->todos->each->updateQuietly(['completed' => true]);
                $project->updateQuietly(['completed' => true]);
            });

        Project::inRandomOrder()
            ->limit(15)
            ->get()
            ->each(function (Project $project) {
                User::factory()
                    ->count(random_int(2, 4))
                    ->create()
                    ->each(fn($user) => $project->addToTeam($user));
            });

        DB::commit();
    }
}
