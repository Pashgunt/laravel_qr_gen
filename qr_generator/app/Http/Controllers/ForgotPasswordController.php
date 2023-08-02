<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\RecoveryPasswordMailJob;
use App\Qr\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function store(PasswordRequest $request)
    {
        $userDTO = $request->makeDTO();

        RecoveryPasswordMailJob::dispatchSync($userDTO->getValidateedData());

        return back()->with(['status' => __(Password::RESET_LINK_SENT)]);
    }

    public function resetPasswordIndex(Request $request)
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
            : back()->withErrors(['email' => [__($status)]]);
    }
}
