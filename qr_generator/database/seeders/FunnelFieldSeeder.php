<?php

namespace Database\Seeders;

use App\Models\FunnelFields;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FunnelFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FunnelFields::factory(2)->create();
    }
}
