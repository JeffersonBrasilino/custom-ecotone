<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Messaging;

interface MetadataStore
{
    public function addMetadata(string $key, $value): void;

    public function getMetadata(string $key);

    public function getAllMetadata(): array;
}
