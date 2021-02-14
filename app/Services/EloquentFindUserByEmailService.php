<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserNotfoundException;
use App\Models\User;

class EloquentFindUserByEmailService implements FindUserByEmailService
{
    /**
     * {@inheritDoc}
     */
    public function run(string $email): User
    {
        $user = User::whereEmail($email)->first();

        if (is_null($user)) {
            throw new UserNotfoundException($email);
        }

        return $user;
    }
}
