<?php

declare(strict_types=1);

namespace Frete\Core\Infrastructure\Ecotone\Brokers;

use Ecotone\Enqueue\EnqueueInboundChannelAdapter;
use Ecotone\Messaging\Endpoint\PollingConsumer\ConnectionException;
use Ecotone\Messaging\Message;
use Exception;
use Interop\Queue\Message as EnqueueMessage;

abstract class CustomEnqueueInboundChannelAdapter extends EnqueueInboundChannelAdapter
{
    private bool $initialized = false;

    public function receiveMessage(int $timeout = 0): ?Message
    {
        try {
            if ($this->declareOnStartup && false === $this->initialized) {
                $this->initialize();

                $this->initialized = true;
            }

            $consumer = $this->connectionFactory->getConsumer(
                $this->connectionFactory->createContext()->createQueue($this->queueName)
            );

            /** @var array|bool $consumableParamsMessage */
            $consumableParamsMessage = $this->getMessageParamsConsume();
            if (!$consumableParamsMessage) {
                return null;
            }

            if (is_array($consumableParamsMessage)) {
                // @phpstan-ignore-next-line
                $consumer->getQueue()->setPartition($consumableParamsMessage['partition']);
                // @phpstan-ignore-next-line
                $consumer->setOffset($consumableParamsMessage['offset']);
            }

            /** @var ?EnqueueMessage $message */
            $message = $consumer->receive($timeout ?: $this->receiveTimeoutInMilliseconds);
            if (!$message) {
                return null;
            }

            $convertedMessage = $this->inboundMessageConverter->toMessage($message, $consumer);
            $convertedMessage = $this->enrichMessage($message, $convertedMessage);

            return $convertedMessage->build();
        } catch (Exception $exception) {
            // @phpstan-ignore-next-line
            if ($this->isConnectionException($exception) || ($exception->getPrevious() && $this->isConnectionException($exception->getPrevious()))) {
                throw new ConnectionException('There was a problem while polling message channel', 0, $exception);
            }

            throw $exception;
        }
    }

    protected function getMessageParamsConsume()
    {
        return true;
    }

    private function isConnectionException(Exception $exception): bool
    {
        // @phpstan-ignore-next-line
        return is_subclass_of($exception, $this->connectionException()) || $exception::class === $this->connectionException();
    }
}
