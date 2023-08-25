<?php

namespace App\Http\Controllers;

use App\Actions\ShowFunnelOptionsAction;
use App\Actions\UpdateQrCodesAction;
use App\Filters\FunnelTypeFilter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AjaxController extends Controller
{
    public function updateQr(
        Request $request,
        UpdateQrCodesAction $updateQrCode,
    ): Response {
        $result = $updateQrCode->handle($request);

        return $this->prepareResultForAjax($result);
    }

    public function funnelOptions(
        FunnelTypeFilter $filter,
        ShowFunnelOptionsAction $funnelOptions
    ): Response {
        $options = $funnelOptions->handle($filter);

        return response($options, 200);
    }
}
