<?php

namespace App\Http\Controllers;

use App\Filters\NotificationConfigFilter;
use App\Http\Requests\NotificationConfigRequest;
use App\Models\Company;
use App\Models\NotificationConfig;
use App\QR\Repositories\NotificationConfigRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class NotificationConfigController extends Controller
{
    public function index(Request $request): View
    {
        $configs = NotificationConfig::joined()
            ->filter(new NotificationConfigFilter($request))
            ->getParams();

        return view('notificatio-configs.notificatio-config-index', compact('configs'));
    }

    public function create()
    {
        $companies = Company::filter()->get();
        return view('notificatio-configs.notificatio-config-create', compact('companies'));
    }

    public function store(NotificationConfigRequest $request)
    {
        $configDTO = $request->makeDTO();

        $result = (bool)app(NotificationConfigRepository::class)
            ->createConfig(
                $configDTO->getCompanyID(),
                $configDTO->getEmail(),
                $configDTO->getIsSendPositive(),
                $configDTO->getIsSendNegative(),
            );

        return $this->prepareResultForUpdate(
            $result,
            'Succes edit',
            'Error edit',
            'notification-config.index'
        );
    }

    public function edit(Request $request)
    {
        $config = NotificationConfig::filter(new NotificationConfigFilter($request))
            ->first();
        $companies = Company::filter()->get();

        return view('notificatio-configs.notificatio-config-edit', compact('config', 'companies'));
    }

    public function update(
        NotificationConfigRequest $request,
        int $id
    ) {
        $configDTO = $request->makeDTO();

        $result = app(NotificationConfigRepository::class)
            ->updateConfig(
                NotificationConfig::filter(
                    new NotificationConfigFilter(),
                    ['notification_config' => $id]
                ),
                [
                    'company_id' => $configDTO->getCompanyID(),
                    'email' => $configDTO->getEmail(),
                    'is_send_positive' => $configDTO->getIsSendPositive(),
                    'is_send_negative' => $configDTO->getIsSendNegative(),
                ]
            );

        return $this->prepareResultForUpdate(
            $result,
            'Succes edit',
            'Error edit',
            'notification-config.index'
        );
    }

    public function destroy(NotificationConfigFilter $filter)
    {
        $result = app(NotificationConfigRepository::class)
            ->updateConfig(
                NotificationConfig::filter($filter),
                ['is_actual' => 0]
            );

        return $this->prepareResultForUpdate(
            $result,
            'Succes Deleted',
            'Error Deleted',
            'notification-config.index'
        );
    }
}
