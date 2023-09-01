<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\CompanyTableHash;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyTableHash>
 */
class CompanyTableHashFactory extends Factory
{

    protected $model = CompanyTableHash::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'table_number' => fake()->randomDigitNotNull(),
            'hash_value' => Str::random(10),
            'is_actual' => 1,
        ];
    }
}
