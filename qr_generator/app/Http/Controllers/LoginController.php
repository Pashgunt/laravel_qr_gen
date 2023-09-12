<?php

namespace App\Http\Controllers;

use App\Actions\StoreLoginAction;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function store(
        LoginRequest $request,
        StoreLoginAction $storeLogin
    ) {
        $result = $storeLogin->handle($request);
        return $this->prepareResultForUpdate(
            $result['result'],
            'Welcome',
            'Error Login',
            RouteServiceProvider::HOME
        );
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('subdomain')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route("login.index"));
    }
}
