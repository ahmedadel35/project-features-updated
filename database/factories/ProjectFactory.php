<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => fn () => Category::factory()->create(),
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'cost' => $this->faker->randomFloat(2, 0, 9999.99),
            // 'logo' => 'http://images.test/posts/'.random_int(0, 9).'.jpg',
            'completed' => $this->faker->boolean,
        ];
    }
}
