<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\ClientAdapter\Factory;

use Malamdg\DiscordPhpClient\ClientAdapter\ClientAdapterInterface;
use Malamdg\DiscordPhpClient\ClientAdapter\OAuth2Adapter;
use Psr\Http\Client\ClientInterface;

/**
 * Create ClientInterface adapter for oauth2 user usage.
 */
class OAuth2AdapterFactory implements ClientAdapterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public static function createClientAdapter(ClientInterface $httpClient, array $options): ClientAdapterInterface
    {
        return new OAuth2Adapter($httpClient, $options);
    }
}