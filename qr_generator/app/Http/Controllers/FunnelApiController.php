<?php

namespace App\Http\Controllers;

use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;

class FunnelApiController extends Controller
{
    private $funnelService;

    public function __construct()
    {
        $this->funnelService = (new FunnelFactory())
            ->createType(FunnelEnums::TYPE->value, app(FunnelTypesRepository::class));
    }

    public function index(int $id)
    {
        $options = $this->funnelService->prepareFunnelFields($id);
        return response($options, 200);
    }
}
