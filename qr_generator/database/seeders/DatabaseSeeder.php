<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SubdomainUserAuthSeeder::class,
            CompanySeeder::class,
            CompanyTableHashSeeder::class,
            QrLinkSeeder::class,
            QrCodeSeeder::class,
            QrCodePdfSeeder::class,
            FunnelTypeSeeder::class,
            FunnelConfigSeeder::class,
            FunnelFieldSeeder::class,
        ]);
    }
}
