<?php

namespace App\Http\Controllers;

use App\Actions\RegisterUserAction;
use App\Http\Requests\RegistrationRequest;
use App\Qr\Helpers\Subdomain;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }

    public function store(
        RegistrationRequest $request,
        RegisterUserAction $registerUser
    ) {
        $register = $registerUser->handle($request);

        return redirect()
            ->away(
                Subdomain::generateRedirectUrl($register['subdomain']->subdomain, 'login')
            )
            ->with('email', $register['user']->email);
    }
}
