<?php

namespace App\QR\Repositories;

use App\QR\Abstracts\Repositories;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class UserRepository extends Repositories
{
    public function createUser(
        string $name,
        string $email,
        string $password
    ): Model {
        return $this->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
    }

    public function changePasswordForUser(array $validatedData): mixed
    {
        return Password::reset(
            $validatedData,
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );
    }
}
