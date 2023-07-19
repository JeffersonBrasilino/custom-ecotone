<?php

declare(strict_types=1);

namespace Frete\Infrastructure\Controllers;

use Frete\Core\Application\Action;
use Frete\Core\Shared\Result;

abstract class ActionController
{
    public function __invoke(RequestAction $request): mixed
    {
        $action = $this->makeAction($request);
        $result = $this->executeAction($action);

        return $this->processResult($result);
    }

    abstract protected function makeAction(RequestAction $request): Action;

    abstract protected function executeAction(Action $action): Result;

    abstract protected function processResult(Result $result): mixed;
}
