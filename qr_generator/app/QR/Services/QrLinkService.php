<?php

namespace App\Qr\Services;

use App\Filters\QrLinkFilter;
use App\Models\QrLink;
use App\QR\Enums\QrCodeEnums;
use App\QR\Repositories\QrLinkRepository;
use Closure;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrLinkService
{

    private QrLinkFilter $filters;

    public function __construct(QrLinkFilter $filters)
    {
        $this->filters = $filters;
    }

    public function showCompanyPipeline(
        array $data,
        Closure $next
    ): array {
        $data['qr'] = QrLink::joined()
            ->filter($this->filters)
            ->paginateResult();

        return $next($data);
    }

    public function saveQrCodePipeline(
        array $data,
        Closure $next
    ): array {
        app(QrLinkRepository::class)->updateLink(
            QrLink::filter(
                new QrLinkFilter(),
                [
                    'link_id' => $data['link_id'],
                ]
            ),
            ['is_actual' => 0]
        );
        $data['qr'] = QrCode::size((int)QrCodeEnums::SIZE->value)
            ->generate($data['link']);
        return $next($data);
    }
}
