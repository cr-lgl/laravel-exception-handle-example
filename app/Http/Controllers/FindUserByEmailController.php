<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserNotfoundException;
use App\Services\FindUserByEmailService;
use Illuminate\Http\JsonResponse;
use JetBrains\PhpStorm\Pure;

class FindUserByEmailController extends Controller
{
    private FindUserByEmailService $service;

    #[Pure]
    public function __construct(FindUserByEmailService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws UserNotfoundException
     */
    public function __invoke(string $email): JsonResponse
    {
        return response()->json($this->service->run($email)->toArray());
    }
}
