<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'permissions' =>  [
                "platform.index" => "1",
                "platform.systems.roles" => "0",
                "platform.systems.users" => "0",
                "platform.systems.attachment" => "0",
                "platform.booking.read" => '1',
                "platform.booking.write" => '1',
            ],
            'available_car_categories' => $this->comfortCategory()
        ];
    }
    public function comfortCategory(): array
    {
        return ComfortCategory::all()->pluck('title')->toArray();
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
