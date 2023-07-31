<?php

namespace App\Http\Controllers;

use App\QR\Repositories\FunnelTypesRepository;
use App\Qr\Services\FunnelFactory;

class FunnelApiController extends Controller
{
    private $funnelService;

    public function __construct(
        FunnelTypesRepository $funnelTypeRepository
    ) {
        $this->funnelService = (new FunnelFactory())->createType('types', $funnelTypeRepository);
    }

    public function index(int $id)
    {
        $options = $this->funnelService->prepareFunnelFields($id);
        return response($options, 200);
    }
}
