<?php

namespace Database\Seeders;

use App\Models\CompanyTableHash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanyTableHashSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyTableHash::factory(5)->create();
    }
}
