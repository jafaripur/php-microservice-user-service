<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender\Client;

final class EmitSender
{
    public const ACTIONS = [
        'userLoggedIn' => 'user_logged_in',
    ];

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function userLoggedIn(mixed $data, int $delay = 0): ?string
    {
        return $this->client->emit()
            ->setTopicName(self::ACTIONS['userLoggedIn'])
            ->setData($data)
            ->setDelay($delay)
            ->send()
        ;
    }
}
