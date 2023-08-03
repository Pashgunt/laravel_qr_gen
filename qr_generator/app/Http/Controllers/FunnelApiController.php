<?php

namespace App\Http\Controllers;

use App\Filters\FunnelTypeFilter;
use App\QR\Enums\FunnelEnums;
use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;
use Illuminate\Http\Response;

class FunnelApiController extends Controller
{
    private $funnelService;

    public function __construct()
    {
        $this->funnelService = (new FunnelFactory())
            ->createType(FunnelEnums::TYPE->value, app(FunnelTypesRepository::class));
    }

    public function index(FunnelTypeFilter $filter): Response
    {
        $options = $this->funnelService->prepareFunnelFields($filter);
        return response($options, 200);
    }
}
