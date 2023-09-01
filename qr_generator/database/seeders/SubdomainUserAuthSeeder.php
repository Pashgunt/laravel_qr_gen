<?php

namespace Database\Seeders;

use App\Models\SubdomainAuth;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubdomainUserAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubdomainAuth::factory(20)->create();
    }
}
