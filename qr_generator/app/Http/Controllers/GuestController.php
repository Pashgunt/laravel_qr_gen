<?php

namespace App\Http\Controllers;

use App\QR\Helpers\Subdomain;

class GuestController extends Controller
{
    public function index()
    {
        return redirect()->away(Subdomain::generateRedirectUrl(env('APP_URL'), 'registration'));;
    }
}
