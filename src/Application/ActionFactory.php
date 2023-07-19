<?php

declare(strict_types=1);

namespace Frete\Core\Application;

class ActionFactory
{
    private \ArrayObject $map;

    public function __construct(string $actionsEnum)
    {
        $this->map = new \ArrayObject();
        $this->register($actionsEnum);
    }

    public function register(string $actionsEnum): void
    {
        if (!enum_exists($actionsEnum)) {
            throw new \Exception('an enum instance is expected.');
        }
        foreach ($actionsEnum::cases() as $message) {
            $this->map->offsetSet($message->name, $message->value);
        }
    }

    public function exists(string $action): bool
    {
        return $this->map->offsetExists($action);
    }

    public function create(string|\BackedEnum $action, ?array $data = null): Action
    {
        $actionName = ($action instanceof \BackedEnum) ? $action->name : $action;
        $actionType = $this->map->offsetExists($actionName);
        if (!$actionType) {
            throw new \Exception("there is no {$actionName} action on the enum");
        }
        $actionType = $this->map->offsetGet($actionName);

        return null != $data ? new $actionType(...$data) : new $actionType();
    }
}
