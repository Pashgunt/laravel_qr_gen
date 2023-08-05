<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\RecoveryPasswordMailJob;
use App\Qr\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index(): View
    {
        return view('auth.forgot-password');
    }

    public function store(PasswordRequest $request): RedirectResponse
    {
        $userDTO = $request->makeDTO();

        RecoveryPasswordMailJob::dispatchSync($userDTO->getValidateedData());

        return back()->with(['status' => __(Password::RESET_LINK_SENT)]);
    }

    public function resetPasswordIndex(Request $request): View
    {
        $token = $request->route()->parameter('token');
        return view('auth.reset-password', compact('token'));
    }

    public function resetPasswordStore(ResetPasswordRequest $request)
    {
        $userDTO = $request->makeDTO();

        $status = app(UserRepository::class)
            ->changePasswordForUser($userDTO->getValidateedData());

        return $status === Password::PASSWORD_RESET
            ? redirect(route('login'))->with('status', __($status))
            : redirect()->back()->withErrors(['email' => [__($status)]]);
    }
}
