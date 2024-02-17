<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    protected $model = Car::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'model' => $this->faker->randomElement(['Audi A8', 'BMW 7', 'MERCEDES-BENZ C-CLASS', 'Audi A3']),
            'chauffeur' => fake()->name(),
            'booking_status' => false,
            'comfort_category_id' => $this->faker->randomElement($this->comfortCategoryId())
        ];
    }

    public function comfortCategoryId(): array
    {
        return ComfortCategory::all()->pluck('id')->toArray();
    }
}


