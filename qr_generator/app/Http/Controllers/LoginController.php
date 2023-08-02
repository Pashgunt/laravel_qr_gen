<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request)
    {
        $userDTO = $request->makeDTO();
        if (Auth::attempt([
            'email' => $userDTO->getEmail(),
            'password' => $userDTO->getPasswordOrigin()
        ])) {
            return redirect(route('home'));
        }
    }

    public function destroy()
    {
        Auth::logout();
        return redirect(route("login"));
    }
}
