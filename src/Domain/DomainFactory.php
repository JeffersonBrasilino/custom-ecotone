<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

class DomainFactory
{
    private \ArrayObject $map;

    public function __construct(string $types)
    {
        $this->map = new \ArrayObject();
        $this->register($types);
    }

    public function register(string $types): void
    {
        if (!enum_exists($types)) {
            throw new \Exception('an enum instance is expected.');
        }
        foreach ($types::cases() as $type) {
            $this->map->offsetSet($type->name, $type->value);
        }
    }

    public function exists(string $type): bool
    {
        return $this->map->offsetExists($type);
    }

    public function create(string|\BackedEnum $subject, ?array $data = null)
    {
        $typeName = ($subject instanceof \BackedEnum) ? $subject->name : $subject;
        $type = $this->map->offsetGet($typeName);
        if (!$type) {
            return null;
        }

        return null != $data ? new $type(...$data) : new $type();
    }
}
