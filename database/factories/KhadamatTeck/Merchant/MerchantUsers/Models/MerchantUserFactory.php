<?php

namespace Database\Factories\KhadamatTeck\Merchant\MerchantUsers\Models;

use App\KhadamatTeck\Merchant\MerchantUsers\Models\MerchantUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<MerchantUser>
 */
class MerchantUserFactory extends Factory
{

    protected $model = MerchantUser::class;

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
            'status' => 'active',
            'role' => 'Staff',
            'merchant_id'=>1
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
