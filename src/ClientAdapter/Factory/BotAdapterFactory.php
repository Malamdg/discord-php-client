<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\ClientAdapter\Factory;

use Malamdg\DiscordPhpClient\ClientAdapter\BotAdapter;
use Malamdg\DiscordPhpClient\ClientAdapter\ClientAdapterInterface;
use Psr\Http\Client\ClientInterface;


/**
 * Create ClientInterface adapter for bot usage.
 */
class BotAdapterFactory implements ClientAdapterFactoryInterface
{

    /**
     * @inheritDoc
     */
    public static function createClientAdapter(ClientInterface $httpClient, array $options): ClientAdapterInterface
    {
        return new BotAdapter($httpClient, $options);
    }
}