<?php

declare(strict_types=1);

namespace Frete\Core\Application;

abstract class IntegrationEvent extends Action
{


    public function __construct(private array $messageHeader = [])
    {
    }

    public function setMessageHeader(array $messageHeader): self
    {
        $this->messageHeader = $messageHeader;
        return $this;
    }

    public function getMessageHeader(): array
    {
        return $this->messageHeader;
    }
}
