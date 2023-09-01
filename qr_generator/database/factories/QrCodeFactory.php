<?php

namespace Database\Factories;

use App\Models\QrCode;
use App\Models\QrLink;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QrCode>
 */
class QrCodeFactory extends Factory
{
    protected $model = QrCode::class;

    public function definition(): array
    {
        return [
            'file_name'=>fake()->imageUrl(640, 480, 'animals', true),
            'file_path'=>fake()->imageUrl(640, 480, 'animals', true),
            'link_id'=>QrLink::factory(),
        ];
    }
}
