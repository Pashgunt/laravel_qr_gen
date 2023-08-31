<?php

namespace App\Actions;

use App\Http\Requests\LoginRequest;
use App\Qr\Helpers\Subdomain;
use Illuminate\Support\Facades\Auth;

class StoreLoginAction
{
    public function handle(LoginRequest $request)
    {
        $userDTO = $request->makeDTO();
        $result = Auth::guard('web')->attempt([
            'email' => $userDTO->getEmail(),
            'password' => $userDTO->getPasswordOrigin()
        ]);

        if ($result) {
            $email = Auth::guard('web')->user()->email;
            $subdomain = Subdomain::getSubdomain($request->getHost());
            $request->session()->regenerate();

            $result = Auth::guard('subdomain')->validate([
                'subdomain' => $subdomain,
                'email' => $email,
            ]);
        }

        return compact('result', 'subdomain');
    }
}
