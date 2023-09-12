<?php

namespace App\Actions;

use App\Http\Requests\LoginRequest;
use App\QR\Helpers\Subdomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreLoginAction
{
    public function handle(LoginRequest $request)
    {
        $userDTO = $request->makeDTO();
        $result = Auth::guard('web')->attempt([
            'email' => $userDTO->getEmail(),
            'password' => $userDTO->getPasswordOrigin()
        ], (int)app(Request::class)->remember_me);
        $subdomain = '';

        if ($result) {
            $email = Auth::guard('web')->user()->email;
            $subdomain = Subdomain::getSubdomain($request->getHost());
            $request->session()->regenerate();

            $result = Auth::guard('subdomain')->validate([
                'subdomain' => $subdomain,
                'email' => $email,
            ]);
        }

        dd($result,$subdomain);

        return compact('result', 'subdomain');
    }
}
