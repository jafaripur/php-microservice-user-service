<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender\AsyncSender;
use Araz\MicroService\Sender\Client;
use Araz\MicroService\Sender\CommandSender as MainCommandSender;

final class CommandSender
{
    private Client $client;

    public const ACTIONS = [
        'getUserInformation' => ['user_service_command', 'get_profile_info'],
    ];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getUserInformation(mixed $data, int $timeout = MainCommandSender::COMMAND_MESSAGE_TIMEOUT, int $priority = 0): mixed
    {
        return $this->client->command()
            ->setQueueName(self::ACTIONS['getUserInformation'][0])
            ->setJobName(self::ACTIONS['getUserInformation'][1])
            ->setData($data)
            ->setPriority($priority)
            ->send();
    }

    public function async(?int $timeout = AsyncSender::COMMAND_ASYNC_MESSAGE_TIMEOUT): CommandAsyncSender
    {
        return new CommandAsyncSender($this->client, $timeout);
    }
}
