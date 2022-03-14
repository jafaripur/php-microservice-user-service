<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender\Client;

final class TopicSender
{
    private const ROUTING_KEYS = [
        'user_topic_create',
        'user_topic_update',
    ];

    public const ACTIONS = [
        'userChanged' => 'user_changed',
    ];

    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function userChanged(string $routingKey, mixed $data, int $delay = 0): ?string
    {
        if (!in_array($routingKey, self::ROUTING_KEYS, true)) {
            throw new \LogicException(sprintf('Routing key not available: %s', $routingKey));
        }

        return $this->client->topic()
            ->setTopicName(self::ACTIONS['userChanged'])
            ->setRoutingKey($routingKey)
            ->setData($data)
            ->setDelay($delay)
            ->send();
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
