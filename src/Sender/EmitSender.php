<?php

declare(strict_types=1);

namespace Araz\Service\User\Sender;

use Araz\MicroService\Sender;

final class EmitSender
{
    private Sender $sender;

    public const ACTIONS = [
        'userLoggedIn' => 'user_logged_in',
    ];

    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public function userLoggedIn(mixed $data, ?int $delay = 0): string|null
    {
        return $this->sender->emit(self::ACTIONS['userLoggedIn'], $data, $delay);
    }
}
