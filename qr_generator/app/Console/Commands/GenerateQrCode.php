<?php

namespace App\Console\Commands;

use App\QR\Enums\QrCodeEnums;
use App\QR\Services\SaveQrCodeData;
use App\QR\Services\SaveQrCodePdfData;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Console\Command;
use Illuminate\Pipeline\Pipeline;

class GenerateQrCode extends Command
{
    protected $signature = 'app:generate-qr-code {link} {company_hash_id}';

    protected $description = 'Create new QR Code';

    public function handle(): void
    {
        app(Pipeline::class)
            ->send([
                'qr' => QrCode::size((int)QrCodeEnums::SIZE->value)->generate($this->argument('link')),
                'link' => $this->argument('link'),
                'company_hash_id' => $this->argument('company_hash_id'),
            ])
            ->through([
                SaveQrCodeData::class,
                SaveQrCodePdfData::class
            ])
            ->via('saveQrCodePipeline')
            ->then();
    }
}
