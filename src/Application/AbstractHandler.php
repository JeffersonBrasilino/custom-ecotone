<?php

declare(strict_types=1);

namespace Frete\Core\Application;

use Frete\Core\Domain\Event;
use Frete\Core\Shared\Result;

abstract class AbstractHandler implements Handler
{
    public function handle(Action|Event $actionOrEvent): Result
    {
        $result = $this->runValidator($actionOrEvent);

        if ($result->isFailure()) {
            return $result;
        }

        $result = $this->run($actionOrEvent);

        if ($result->isFailure()) {
            return $result;
        }

        $result = $this->runRepository($result);

        if ($result->isFailure()) {
            return $result;
        }

        $result = $this->runDispatch($result);

        if ($result->isFailure()) {
            return $result;
        }

        return $result;
    }

    abstract protected function runValidator(Action|Event $actionOrEvent): Result;

    abstract protected function run(Action|Event $actionOrEvent): Result;

    abstract protected function runRepository(Result $result): Result;

    abstract protected function runDispatch(Result $result): result;
}
