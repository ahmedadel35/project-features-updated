<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Project;
use App\Models\Todo;
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

        $admin = User::factory()->create([
            'name' => 'Ahmed Adel',
            'email' => 'admin@admin.com',
        ]);

        $cats = Category::factory()
            ->has(
                Project::factory()
                    ->count(7)
                    ->has(Todo::factory()->count(random_int(3, 8)))
            )
            ->count(5)
            ->create([
                'user_id' => $admin->id,
            ]);

        foreach (range(1, 3) as $i) {
            Project::latest()
                ->first()
                ->addToTeam(User::factory()->create());
        }

        User::factory(3)
            ->create()
            ->each(function (User $user) {
                // create categories for each user

                Category::factory()
                    ->count(random_int(1, 2))
                    ->has(
                        Project::factory()
                            ->count(random_int(1, 2))
                            ->has(Todo::factory()->count(1, 2))
                    )
                    ->create([
                        'user_id' => $user->id,
                    ]);
            });

        DB::commit();
    }
}
