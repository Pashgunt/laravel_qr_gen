<?php

namespace App\Qr\Services;

use App\Filters\QrLinkFilter;
use App\Models\QrLink;
use Closure;

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
            ->paginate(10, [
                'qr_codes.file_name AS svg_file_name',
                'qr_codes.file_path AS svg_file_path',
                'company_table_hash.*',
                'qr_codes_pdf.*',
                'links_for_qr_code.*',
            ]);
        return $next($data);
    }
}
