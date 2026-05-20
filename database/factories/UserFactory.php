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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
            'bio' => fake()->sentence(12),
            'avatar' => 'https://images.unsplash.com/photo-' . fake()->randomElement([
                '1535713875002-d1d0cf377fde', '1494790108377-be9c29b29330', '1570295999919-56ceb5ecca61', 
                '1438761681033-6461ffad8d80', '1507003211169-0a1dd7228f2d', '1500648767791-00dcc994a43e',
                '1544005313-94ddf0286df2', '1527983359383-4758693f760c', '1508214751196-bcfd4ca60f91',
                '1534528741775-53994a69daeb'
            ]) . '?auto=format&fit=crop&w=150&h=150&q=80',
        ];
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
