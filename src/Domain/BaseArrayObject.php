<?php

declare(strict_types=1);

namespace Frete\Core\Domain;

class BaseArrayObject extends \ArrayObject
{
    protected $data = [];

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function add($item): void
    {
        $this->data[] = $item;
    }

    public function count(): int
    {
        return count($this->data);
    }

    public function filter(callable $callback): array
    {
        return array_filter($this->data, $callback);
    }

    public function get(int $index): mixed
    {
        return $this->data[$index];
    }

    public function getAll(): array
    {
        return $this->data;
    }

    public function getIterator(): \Iterator
    {
        return new \ArrayIterator($this->data);
    }

    public function has($item): bool
    {
        return in_array($item, $this->data, true);
    }

    public function remove($item): void
    {
        $index = array_search($item, $this->data, true);

        if (false === $index) {
            return;
        }

        unset($this->data[$index]);
    }
}
