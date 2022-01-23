<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender;

final class TopicSender
{
    private const ROUTING_KEYS = [
        'user_topic_create',
        'user_topic_update',
    ];

    public const ACTIONS = [
        'userChanged' => 'user_changed',
    ];

    private Sender $sender;

    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function userChanged(string $routingKey, mixed $data, ?int $delay = 0): string|null
    {
        if (!in_array($routingKey, self::ROUTING_KEYS, true)) {
            throw new \LogicException(sprintf('Routing key not available: %s', $routingKey));
        }

        return $this->sender->topic(self::ACTIONS['userChanged'], $routingKey, $data, $delay);
    }

    public function getRoutingKeyUserTopicCreate(): string
    {
        return 'user_topic_create';
    }

    public function getRoutingKeyUserTopicUpdate(): string
    {
        return 'user_topic_update';
    }
}
