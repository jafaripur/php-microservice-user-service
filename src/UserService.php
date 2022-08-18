<?php

/**
 * User service implement.
 */

declare(strict_types=1);

namespace Araz\Service\User;

use Araz\MicroService\Queue;
use Araz\Service\User\Sender\CommandSender;
use Araz\Service\User\Sender\EmitSender;
use Araz\Service\User\Sender\TopicSender;
use Araz\Service\User\Sender\WorkerSender;

final class UserService
{
    private Queue $queue;

    private ?CommandSender $command = null;

    private ?TopicSender $topic = null;

    private ?EmitSender $emit = null;

    private ?WorkerSender $worker = null;

    public function __construct(Queue $queue)
    {
        $this->queue = $queue;
    }

    public function getQueue(): Queue
    {
        return $this->queue;
    }

    public function commands(): CommandSender
    {
        if (!$this->command) {
            $this->command = new CommandSender($this->queue->getClient());
        }

        return $this->command;
    }

    public function emits(): EmitSender
    {
        if (!$this->emit) {
            $this->emit = new EmitSender($this->queue->getClient());
        }

        return $this->emit;
    }

    public function topics(): TopicSender
    {
        if (!$this->topic) {
            $this->topic = new TopicSender($this->queue->getClient());
        }

        return $this->topic;
    }

    public function workers(): WorkerSender
    {
        if (!$this->worker) {
            $this->worker = new WorkerSender($this->queue->getClient());
        }

        return $this->worker;
    }
}
