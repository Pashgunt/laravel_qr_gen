<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return view('auth.verify-email');
    }

    public function init(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect(route('home'));
    }

    public function sendNewLink(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }
}
