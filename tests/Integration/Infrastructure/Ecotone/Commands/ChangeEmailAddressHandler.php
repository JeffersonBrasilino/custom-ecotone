<?php

declare(strict_types=1);

namespace Tests\Integration\Infrastructure\Ecotone\Commands;

use Ecotone\Modelling\Attribute\CommandHandler;
use Frete\Core\Application\Command;

class ChangeEmailAddressHandler implements Command
{
    #[CommandHandler]
    public function handle(ChangeEmailAddressCommand $command) : void
    {
        // retrieve user and change the email
    }
}
