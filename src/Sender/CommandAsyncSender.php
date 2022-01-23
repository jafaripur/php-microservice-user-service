<?php

/**
 * User service implement
 */

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\AsyncSender;
use Araz\MicroService\Sender;
use Generator;

final class CommandAsyncSender
{
    private AsyncSender $asyncSender;

    public function __construct(Sender $sender, int $timeout)
    {
        $this->asyncSender = $sender->async($timeout);
    }

    public function getUserInformation(mixed $data, string $correlationId, int $timeout, ?int $priority = null): self
    {
        $this->asyncSender->command(CommandSender::ACTIONS['getUserInformation'][0], CommandSender::ACTIONS['getUserInformation'][1], $data, $correlationId, $timeout, $priority);
        return $this;
    }

    public function receive(): Generator
    {
        return $this->asyncSender->receive();
    }
}
