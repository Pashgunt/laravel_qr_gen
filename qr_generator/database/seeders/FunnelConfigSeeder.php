<?php

namespace Database\Seeders;

use App\Models\FunnelConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunnelConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FunnelConfig::factory(2)->create();
    }
}
