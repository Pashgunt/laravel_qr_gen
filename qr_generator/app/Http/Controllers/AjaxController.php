<?php

namespace App\Http\Controllers;

use App\Actions\UpdateQrCodesAction;
use App\Filters\FunnelTypeFilter;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AjaxController extends Controller
{
    public function updateQr(
        Request $request,
        UpdateQrCodesAction $updateQrCode,
    ): Response {
        $updateQrCode->handle($request);

        return response('ok', 200);
    }

    public function funnelOptions(FunnelTypeFilter $filter): Response
    {
        $options = (new FunnelFactory())
            ->createType(FunnelEnums::TYPE->value, app(FunnelTypesRepository::class))
            ->prepareFunnelFields($filter);
            
        return response($options, 200);
    }
}
