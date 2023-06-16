<?php

declare(strict_types=1);

return [
    // @phpstan-ignore-next-line
    'serviceName' => env('ECOTONE_SERVICE_NAME') ? env('ECOTONE_SERVICE_NAME') : env('APP_NAME'),
    'loadAppNamespaces' => true,
    'namespaces' => [
        'Frete\\Core'
    ],
    // @phpstan-ignore-next-line
    'cacheConfiguration' => env('ECOTONE_CACHE', false),
    // @phpstan-ignore-next-line
    'defaultSerializationMediaType' => env('ECOTONE_DEFAULT_SERIALIZATION_TYPE'),
    // @phpstan-ignore-next-line
    'defaultErrorChannel' => env('ECOTONE_DEFAULT_ERROR_CHANNEL'),
    'defaultConnectionExceptionRetry' => null,
    'skippedModulePackageNames' => [],
];
