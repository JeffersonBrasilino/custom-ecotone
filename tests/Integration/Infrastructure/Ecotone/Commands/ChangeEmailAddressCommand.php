<?php

declare(strict_types=1);

namespace Tests\Integration\Infrastructure\Ecotone\Commands;

class ChangeEmailAddressCommand
{
    public function __construct(private string $userId, private string $email) {}

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
