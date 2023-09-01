<?php

namespace Database\Seeders;

use App\Models\QrPdf;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QrCodePdfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QrPdf::factory(5)->create();
    }
}
