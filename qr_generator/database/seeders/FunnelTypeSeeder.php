<?php

namespace Database\Seeders;

use App\Models\FunnelTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunnelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FunnelTypes::factory(1)->create();
    }
}
