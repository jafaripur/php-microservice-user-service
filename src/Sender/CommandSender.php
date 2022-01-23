<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\AsyncSender;
use Araz\MicroService\Sender;

final class CommandSender
{
    private Sender $sender;

    public const ACTIONS = [
        'getUserInformation' => ['user_service_command', 'get_profile_info'],
    ];

    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function getUserInformation(mixed $data, int $timeout = Sender::COMMAND_MESSAGE_TIMEOUT, ?int $priority = null): mixed
    {
        return $this->sender->command(self::ACTIONS['getUserInformation'][0], self::ACTIONS['getUserInformation'][1], $data, $timeout, $priority);
    }

    public function async(?int $timeout = AsyncSender::COMMAND_ASYNC_MESSAGE_TIMEOUT): CommandAsyncSender
    {
        return new CommandAsyncSender($this->sender, $timeout);
    }
}
