<?php

declare(strict_types=1);

namespace Frete\Infrastructure\Controllers;

interface RequestAction
{
    public function getActionData(?string $key = null): mixed;
}
