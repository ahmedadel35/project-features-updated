<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => fn () => User::factory(),
            'title' => $this->faker->sentence(3),
            'slug' => Str::slug(fake()->sentence(2)),
            'description' => fake()->paragraph,
        ];
    }
}
