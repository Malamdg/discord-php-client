<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\ClientAdapter\Factory;

use Malamdg\DiscordPhpClient\ClientAdapter\ClientAdapterInterface;
use Psr\Http\Client\ClientInterface;

class ClientAdapterFactory implements ClientAdapterFactoryInterface
{

    /**
     * Creates a factory to adapt HttpClientInterface for bot.
     *
     * @return BotAdapterFactory
     */
    public static function createBotAdapterFactory(): BotAdapterFactory
    {
        return new BotAdapterFactory();
    }

    /**
     * Creates a factory to adapt HttpClientInterface for oauth2.
     *
     * @return OAuth2AdapterFactory
     */
    public static function createOAuth2AdapterFactory(): OAuth2AdapterFactory
    {
        return new OAuth2AdapterFactory();
    }

    /**
     * Factory method to create factory accordingly to options.
     *
     * @param array $options
     *
     * @return ClientAdapterFactoryInterface
     */
    public static function createFactoryForOptions(array $options): ClientAdapterFactoryInterface
    {
        return match (true) {
            array_key_exists("bot_token", $options) => static::createBotAdapterFactory(),
            default => static::createOAuth2AdapterFactory()
        };
    }

    /**
     * @inheritDoc
     */
    public static function createClientAdapter(ClientInterface $httpClient, array $options): ClientAdapterInterface
    {
        $factory = self::createFactoryForOptions($options);
        return $factory::createClientAdapter($httpClient, $options);
    }
}