<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

class UserNotfoundException extends Exception
{
    #[Pure]
    public function __construct(string $email)
    {
        parent::__construct("User Notfound: {$email}");
    }
}
