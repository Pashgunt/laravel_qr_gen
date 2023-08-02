<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Jobs\RegisterMailJob;
use App\Qr\Repositories\UserRepository;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('auth.registration');
    }

    public function store(RegistrationRequest $request)
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
