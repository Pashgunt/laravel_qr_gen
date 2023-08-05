<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $userDTO = $request->makeDTO();
        $res = Auth::attempt([
            'email' => $userDTO->getEmail(),
            'password' => $userDTO->getPasswordOrigin()
        ]);
        return $this->prepareResultForUpdate($res, 'Welcome', 'Error Login', 'home');
    }

    public function destroy()
    {
        Auth::logout();
        return redirect(route("login"));
    }
}
