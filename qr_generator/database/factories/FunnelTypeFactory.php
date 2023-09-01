<?php

namespace Database\Factories;

use App\Models\FunnelTypes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FunnelTypeFactory extends Factory
{

    protected $model = FunnelTypes::class;

    public function definition(): array
    {
        return [
            'funnel_type_tag' => 'feedback',
            'funnel_type_name' => 'Отзывы',
            'is_actual' => 1,
        ];
    }
}
