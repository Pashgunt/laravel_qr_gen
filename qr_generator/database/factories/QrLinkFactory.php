<?php

namespace Database\Factories;

use App\Models\CompanyTableHash;
use App\Models\QrLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QrLinkFactory extends Factory
{
    protected $model = QrLink::class;

    public function definition(): array
    {
        return [
            'company_hash_id' => CompanyTableHash::factory(),
            'link' => fake()->url(),
            'is_actual' => 1,
        ];
    }
}
