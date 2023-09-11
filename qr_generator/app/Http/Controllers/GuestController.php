<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class GuestController extends Controller
{
    public function index()
    {
        return redirect(route('registration.index'));
        // return view('guest.guest');
    }
}
