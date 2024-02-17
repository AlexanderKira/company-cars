<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComfortCategory>
 */
class ComfortCategoryFactory extends Factory
{
    protected $model = ComfortCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->randomElement(["luxury", "representative", "average", "golf"]),
            'description' => $this->faker->text(255),
        ];

    }
}
