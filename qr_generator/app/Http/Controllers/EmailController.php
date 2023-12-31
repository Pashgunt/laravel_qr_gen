<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class EmailController extends Controller
{
    public function index(): View
    {
        return view('auth.verify-email');
    }

    public function init(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect(route(RouteServiceProvider::HOME));
    }

    public function sendNewLink(Request $request): RedirectResponse
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
