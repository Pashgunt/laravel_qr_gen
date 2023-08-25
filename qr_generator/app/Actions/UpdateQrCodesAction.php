<?php

namespace App\Actions;

use App\Filters\QrLinkFilter;
use App\Models\Company;
use App\Models\QrLink;
use App\QR\Enums\QrCodeEnums;
use App\Qr\Services\CompanyTableHashService;
use App\Qr\Services\QrLinkService;
use App\QR\Services\SaveQrCodeData;
use App\QR\Services\SaveQrCodePdfData;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Crypt;

class UpdateQrCodesAction
{
    public function handle(Request $request): bool
    {
        $qrLinkRaws = QrLink::joined()
            ->filter(new QrLinkFilter($request))
            ->get();

        foreach ($qrLinkRaws as $qrLink) {
            $company = Company::find($qrLink->company_id);
            $hash = Crypt::encryptString($company->name);
            $data = [
                'company_id' => $company->id,
                'table_number' => $qrLink->table_number,
                'hash_value' => $hash,
                'company_hash_id' => $qrLink->company_hash_id,
                'link_id' => $qrLink->link_id,
                'link' => sprintf(QrCodeEnums::QR_PREFIX->value . "/%s", $hash),
            ];
            app(Pipeline::class)
                ->send($data)
                ->through([
                    CompanyTableHashService::class,
                    QrLinkService::class,
                    SaveQrCodeData::class,
                    SaveQrCodePdfData::class,
                ])
                ->via('saveQrCodePipeline')
                ->thenReturn();
        }

        return true;
    }
}
