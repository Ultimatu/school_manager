<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Administration>
 */
class AdministrationFactory extends Factory
{

    protected static ?string $password;
    protected static Model $model = \App\Models\Administration::class;
    protected static Model $user = \App\Models\User::class;

    protected static ?string $user_id = null;

    protected static ?string $email = null;

    protected static ?string $role = null;

    protected static ?string $first_name = null;

    protected static ?string $last_name = null;

    protected static ?string $phone = null;

    protected static ?string $address = null;

    protected static ?string $avatar = null;

    protected static ?string $status = null;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'phone' => fake()->unique()->phoneNumber(),
            'address' => fake()->address(),
            'avatar' => 'users/default.png',
            'role' => fake()->randomElement(['admin', 'consellor', 'comptable']),
            'status' => 1,
            'responsibility' => fake()->sentence(),
        ];
    }
}
