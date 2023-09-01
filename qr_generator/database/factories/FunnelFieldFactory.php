<?php

namespace Database\Factories;

use App\Models\FunnelConfig;
use App\Models\FunnelFields;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FunnelFieldFactory extends Factory
{
    protected $model = FunnelFields::class;

    public function definition(): array
    {
        return [
            'funnel_config_id' => FunnelConfig::factory(),
            'field_name' => 'rating',
            'operator' => 'equal',
            'value' => 5,
            'value_range_from' => NULL,
            'value_range_to' => NULL,
            'is_actual' => 1,
        ];
    }
}
