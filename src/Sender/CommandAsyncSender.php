<?php

/**
 * User service implement
 */

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender\AsyncSender;
use Araz\MicroService\Sender\Client;
use Generator;

final class CommandAsyncSender
{
    private AsyncSender $asyncSender;

    public function __construct(Client $client, int $timeout)
    {
        $this->asyncSender = $client->async($timeout);
    }

    public function getUserInformation(mixed $data, string $correlationId, int $timeout, int $priority = 0): self
    {
        $this->asyncSender->command(CommandSender::ACTIONS['getUserInformation'][0], CommandSender::ACTIONS['getUserInformation'][1], $data, $correlationId, $timeout, $priority);
        return $this;
    }

    public function receive(): Generator
    {
        return $this->asyncSender->receive();
    }
}
