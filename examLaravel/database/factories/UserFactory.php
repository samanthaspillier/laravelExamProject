<?php

namespace Database\Factories;

use App\Models\User;

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
        $number = $this->faker->unique()->randomNumber();
        $domain = $this->faker->unique()->domainWord; // Generates a random domain word

        return [
            'name' => $this->faker->name,
            'email' => strtolower($this->faker->firstName) . '.' . strtolower($this->faker->lastName) . '.' . $number . '@' . $domain . '.com',
            'password' => Hash::make('Password!123'), // Default password for all
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'birthday' => $this->faker->dateTimeBetween('-90 years', '-18 years')->format('Y-m-d'),
            'bio' => $this->faker->sentence,
            'is_admin' => false, // Default to non-admin
        ];
    }

    public function admin(): self
    {
        return $this->state([
            'is_admin' => true,
        ]);
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
