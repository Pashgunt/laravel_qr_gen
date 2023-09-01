<?php

namespace Database\Factories;

use App\Models\SubdomainAuth;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubdomainUserAuthFactory extends Factory
{
    protected $model = SubdomainAuth::class;

    public function definition(): array
    {
        return [
            'subdomain' => fake()->word() . env('APP_URL'),
            'email' => fake()->unique()->safeEmail(),
            'user_id' => User::factory(),
            'is_actual' => 1,
        ];
    }
}
