<?php

namespace App\Http\Controllers;

use App\Actions\UpdateQrCodesAction;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function updateQr(
        Request $request,
        UpdateQrCodesAction $updateQrCode,
    ) {
        $updateQrCode->handle($request);

        return response('ok', 200);
    }
}
