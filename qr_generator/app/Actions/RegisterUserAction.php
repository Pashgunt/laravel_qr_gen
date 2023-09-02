<?php

namespace App\Actions;

use App\Events\RegisteredUser;
use App\Http\Requests\RegistrationRequest;
use App\QR\Repositories\SubdomainAuthRepository;
use App\Qr\Repositories\UserRepository;

class RegisterUserAction
{
    public function handle(RegistrationRequest $request): array
    {
        $userDTO = $request->makeDTO();

        $user = app(UserRepository::class)
            ->createUser(
                $userDTO->getName(),
                $userDTO->getEmail(),
                $userDTO->getPassword()
            );

        if ($user) {
            $subdomain = app(SubdomainAuthRepository::class)
                ->createSubdomain(
                    sprintf('%s.%s', $userDTO->getEmailSubdomain(), env('APP_URL')),
                    $userDTO->getEmail(),
                    $user->id
                );

            event(new RegisteredUser($user, $subdomain));
        }


        return compact('user', 'subdomain');
    }
}
