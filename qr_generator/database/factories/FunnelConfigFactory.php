<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\FunnelConfig;
use App\Models\FunnelTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FunnelConfig>
 */
class FunnelConfigFactory extends Factory
{
    protected $model = FunnelConfig::class;
    public function definition(): array
    {
        return [
            'funnel_type_id' => FunnelTypes::factory(),
            'work_started_at' => fake()->date(),
            'is_actual' => 1,
            'company_id' => Company::factory(),
        ];
    }
}
