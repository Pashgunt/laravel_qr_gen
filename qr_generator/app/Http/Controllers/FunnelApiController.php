<?php

namespace App\Http\Controllers;

use App\QR\Repositories\FunnelTypesRepository;
use App\QR\Repositories\LocationFeedbackRepository;
use App\QR\Services\FunnelService;

class FunnelApiController extends Controller
{

    private FunnelService $funnelService;
    private FunnelTypesRepository $funnelTypeRepository;

    public function __construct(
        FunnelTypesRepository $funnelTypeRepository,
        LocationFeedbackRepository $locationFeedbackRepository
    ) {
        $this->funnelTypeRepository = $funnelTypeRepository;
        $this->funnelService = new FunnelService(
            $funnelTypeRepository,
            $locationFeedbackRepository
        );
    }

    public function index(int $id)
    {
        $options = $this->funnelService->prepareFunnelFields($id);
        return response($options, 200);
    }
}
