<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Routing\Redirector;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function prepareResultForUpdate(
        bool $res,
        string $successMessage,
        string $errorMessage,
        string $routeName
    ) {
        return $res ? redirect(route($routeName))->with('message', $successMessage) :
            redirect()->back()->withErrors('message_err', $errorMessage);
    }

    protected function prepareResultForAjax($resut)
    {
        return $resut ? response('ok') : response('error', 401);
    }
}
