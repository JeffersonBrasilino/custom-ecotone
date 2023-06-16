<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Laravel;

use Frete\Core\Application\Dispatcher;
use Frete\Core\Infrastructure\Ecotone\Converters\{JsonToPhpConverter, PhpToJsonConverter};
use Frete\Core\Infrastructure\Ecotone\Dispatcher\DispatcherBus;
use Illuminate\Support\ServiceProvider;

class FreteCoreProvider extends ServiceProvider
{
    public function register()
    {
        // @phpstan-ignore-next-line
        $this->app->register(\Ecotone\Laravel\EcotoneProvider::class);
        // @phpstan-ignore-next-line
        $this->app->singleton(JsonToPhpConverter::class, JsonToPhpConverter::class);
        // @phpstan-ignore-next-line
        $this->app->singleton(PhpToJsonConverter::class, PhpToJsonConverter::class);
        // @phpstan-ignore-next-line
        $this->app->bind(Dispatcher::class, DispatcherBus::class);
    }

    public function boot()
    {
        // @phpstan-ignore-next-line
        $this->publishes([
            // @phpstan-ignore-next-line
            __DIR__ . '/Config/ecotone.php' => config_path('ecotone.php')
        ], 'ecotone-frete-core-config');
    }
}
