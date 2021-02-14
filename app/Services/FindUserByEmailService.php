<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserNotfoundException;
use App\Models\User;

interface FindUserByEmailService
{
    /**
     * @throws UserNotfoundException
     */
    public function run(string $email): User;
}
