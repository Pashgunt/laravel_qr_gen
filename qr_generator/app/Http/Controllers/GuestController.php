<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class GuestController extends Controller
{
    public function index(): View
    {
        return view('guest.guest');
    }
}
