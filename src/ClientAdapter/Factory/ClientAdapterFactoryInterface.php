<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\ClientAdapter\Factory;

use Malamdg\DiscordPhpClient\ClientAdapter\ClientAdapterInterface;
use Malamdg\DiscordPhpClient\ClientAdapter\Exception\ClientAdapterException;
use Psr\Http\Client\ClientInterface;

/**
 * Interface for ClientAdapterFactory classes.
 */
interface ClientAdapterFactoryInterface
{
    /**
     * Create tailored ClientAdapter for given options.
     *
     * @param ClientInterface $httpClient
     * @param array $options
     *
     * @return ClientAdapterInterface
     * @throws ClientAdapterException
     */
    public static function createClientAdapter(ClientInterface $httpClient, array $options): ClientAdapterInterface;
}