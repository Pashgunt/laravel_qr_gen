<?php

namespace Database\Factories;

use App\Models\QrLink;
use App\Models\QrPdf;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class QrCodePdfFactory extends Factory
{
    protected $model = QrPdf::class;

    public function definition(): array
    {
        return [
            'file_name'=>fake()->imageUrl(640, 480, 'animals', true),
            'file_path'=>fake()->imageUrl(640, 480, 'animals', true),
            'link_id'=>QrLink::factory(),
        ];
    }
}
