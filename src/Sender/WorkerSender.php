<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender;

final class WorkerSender
{
    private Sender $sender;

    public const ACTIONS = [
        'userProfileAnalysis' => ['user_service_worker', 'user_profile_analysis'],
        'userProfileUpdateNotification' => ['user_service_worker', 'user_profile_update_notification'],
    ];

    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function userProfileAnalysis(mixed $data, ?int $priority = null, ?int $expiration = null, ?int $delay = 0): mixed
    {
        return $this->sender->worker(self::ACTIONS['userProfileAnalysis'][0], self::ACTIONS['userProfileAnalysis'][1], $data, $priority, $expiration, $delay);
    }

    public function userProfileUpdateNotification(mixed $data, ?int $priority = null, ?int $expiration = null, ?int $delay = 0): mixed
    {
        return $this->sender->worker(self::ACTIONS['userProfileUpdateNotification'][0], self::ACTIONS['userProfileUpdateNotification'][1], $data, $priority, $expiration, $delay);
    }
}
