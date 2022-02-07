<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender\Client;

final class WorkerSender
{
    private Client $client;

    public const ACTIONS = [
        'userProfileAnalysis' => ['user_service_worker', 'user_profile_analysis'],
        'userProfileUpdateNotification' => ['user_service_worker', 'user_profile_update_notification'],
    ];

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function userProfileAnalysis(mixed $data, int $priority = 0, int $expiration = 0, int $delay = 0): mixed
    {
        return $this->client->worker()
            ->setQueueName(self::ACTIONS['userProfileAnalysis'][0])
            ->setJobName(self::ACTIONS['userProfileAnalysis'][1])
            ->setData($data)
            ->setPriority($priority)
            ->setExpiration($expiration)
            ->setDelay($delay)
            ->send();
    }

    public function userProfileUpdateNotification(mixed $data, int $priority = 0, int $expiration = 0, int $delay = 0): mixed
    {
        return $this->client->worker()
            ->setQueueName(self::ACTIONS['userProfileUpdateNotification'][0])
            ->setJobName(self::ACTIONS['userProfileUpdateNotification'][1])
            ->setData($data)
            ->setPriority($priority)
            ->setExpiration($expiration)
            ->setDelay($delay)
            ->send();
    }
}
