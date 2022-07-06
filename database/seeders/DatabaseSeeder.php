<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\User;
use DB;
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
        // for perfomance
        DB::beginTransaction();

        User::factory()->create([
            'name' => 'Ahmed Adel',
            'email' => 'admin@admin.com',
        ]);

        User::factory(10)->create()->each(function (User $user) {
            // create categories for each user
            /** @var \Illuminate\Database\Eloquent\Collection $cats */
            $cats = $user->categories()->saveMany(
                Category::factory()->count(rand(3, 6))->make()
            );
            
            /** @var \Illuminate\Database\Eloquent\Collection $projects */
            $projects = $cats->each(function (Category $category) {
                $category->projects()->saveMany(
                    Project::factory()->count(random_int(3, 16))->make()
                );
            })->each(function (Project $project) {
                // $project->todos()->sav
            });

            
        });

        DB::commit();
    }
}
