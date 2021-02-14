<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\UserNotfoundException;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use JetBrains\PhpStorm\Pure;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

class GuzzleFindUserByEmailService implements FindUserByEmailService
{
    private Client $client;

    #[Pure]
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritDoc}
     */
    public function run(string $email): User
    {
        try {
            $response = $this->client->get(route('users.find-by-email'));
        } catch (GuzzleException $e) {
            if ($e instanceof ClientException && ($e->getResponse()->getStatusCode() === Response::HTTP_NOT_FOUND)) {
                throw new UserNotfoundException($email);
            }

            throw new RuntimeException('An unknown exception has occurred.', 0, $e);
        }

        $id = json_decode($response->getBody()->getContents(), true)['id'];

        return User::find($id);
    }
}
