<?php

namespace Database\Factories;

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
            \App\ValueObjects\User\Name::NAME => fake()->name(),
            \App\ValueObjects\User\Email::NAME => fake()->unique()->safeEmail(),
            \App\ValueObjects\User\EmailVerifiedAt::NAME => now(),
            \App\ValueObjects\User\Password::NAME => static::$password ??= Hash::make('password'),
            \App\ValueObjects\User\RememberToken::NAME => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            \App\ValueObjects\User\EmailVerifiedAt::NAME => null,
        ]);
    }
}
