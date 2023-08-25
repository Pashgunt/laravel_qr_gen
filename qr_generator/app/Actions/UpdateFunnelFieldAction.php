<?php

namespace App\Actions;

use App\Filters\FunnelFieldFilter;
use App\Http\Requests\FieldRequest;
use App\Models\FunnelFields;
use App\Qr\Repositories\FunnelFieldsRepository;

class UpdateFunnelFieldAction
{
    public function handle(FieldRequest $request): bool
    {
        $funnelFieldDTO = $request->makeDTO();
        $fieldID = $request->route()->parameter('field_id');

        return app(FunnelFieldsRepository::class)->updateFunnelField(
            FunnelFields::filter(new FunnelFieldFilter(null, [
                'field_id' => $fieldID
            ])),
            [
                'field_name' => $funnelFieldDTO->getField(),
                'operator' => $funnelFieldDTO->getOperator(),
                'value' => $funnelFieldDTO->getValue(),
                'value_range_from' => $funnelFieldDTO->getRange()['from'],
                'value_range_to' => $funnelFieldDTO->getRange()['to'],
            ]
        );
    }
}
