<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Project;

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
            'category_id' => $this->faker->word,
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'cost' => $this->faker->randomFloat(0, 0, 9999999999.),
            'logo' => $this->faker->word,
            'completed' => $this->faker->boolean,
        ];
    }
}
