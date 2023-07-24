<?php

namespace App\Jobs;

use App\QR\Enums\QrCodeEnums;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class GenerateQrCodeFiles implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $hashValue;
    private int $companyHashId;

    public function __construct(string $hashValue, int $companyHashId)
    {
        $this->hashValue = $hashValue;
        $this->companyHashId = $companyHashId;
    }

    public function handle(): void
    {
        Artisan::call('app:generate-qr-code', [
            'link' => sprintf(QrCodeEnums::QR_PREFIX->value . "/%s", $this->hashValue),
            'company_hash_id' => $this->companyHashId
        ]);
    }
}
