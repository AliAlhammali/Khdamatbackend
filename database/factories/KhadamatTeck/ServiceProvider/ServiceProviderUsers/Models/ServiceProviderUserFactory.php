<?php

namespace Database\Factories\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models;

use App\KhadamatTeck\ServiceProvider\ServiceProviderUsers\Models\ServiceProviderUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<ServiceProviderUser>
 */
class ServiceProviderUserFactory extends Factory
{
    protected $model = ServiceProviderUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->name(),
            'email' => strtolower(fake()->unique()->firstName) .'@khadamat-teck.com',
            'email_verified_at' => now(),
            'password' => bcrypt(123456), // password
            'remember_token' => Str::random(10),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'image' => fake()->imageUrl(),
            'role' => 'staff',
            'status' => 'active',
            'service_provider_id' => 1,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
