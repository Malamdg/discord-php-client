<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use Berlioz\Http\Message\Factory\RequestFactoryTrait;
use Malamdg\DiscordPhpClient\Exception\DiscordClientException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * @internal
 */
class HttpClientAdapter
{
    use RequestFactoryTrait;

    public function __construct(
        private ClientInterface $client,
        private array           $options,
    )
    {
    }

    /**
     * Get base URI for discord API.
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->options["baseUri"] ?? "https://discordapp.com/api/";
    }

    /**
     * Authenticate to app.
     *
     * @throws DiscordClientException
     */
    public function authenticate(): void
    {
        try {
            $token = $this->options["token"];
            $this->client->sendRequest(
                $this->createRequest(
                    'POST',
                    uri: $this->getBaseUri(),
                    headers: [
                        'Authorization' => 'Bot ' . $token,
                        'Content-Type' => 'application/json',
                    ]
                )
            );
        } catch (Throwable $e) {
            throw DiscordClientException::authenticate($e);
        }
    }

    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request->withUri($request->getUri(), $this->getBaseUri());
            return $this->client->sendRequest($request);
        } catch (Throwable $e) {
            throw DiscordClientException::sendRequest($e);
        }
    }
}