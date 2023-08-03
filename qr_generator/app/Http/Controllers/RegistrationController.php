<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Jobs\RegisterMailJob;
use App\Qr\Repositories\UserRepository;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(): View
    {
        return view('auth.registration');
    }

    public function store(RegistrationRequest $request): Redirector
    {
        $userDTO = $request->makeDTO();

        $user = app(UserRepository::class)->createUser(
            $userDTO->getName(),
            $userDTO->getEmail(),
            $userDTO->getPassword()
        );

        RegisterMailJob::dispatchSync($user);

        return redirect(route('login'))->with('email', $user->email);
    }
}
