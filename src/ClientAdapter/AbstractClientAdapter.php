<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\ClientAdapter;

use Malamdg\DiscordPhpClient\ClientAdapter\Exception\ClientAdapterException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AbstractClientAdapter implements ClientAdapterInterface
{
    private const REQUIRED_PARAMETERS = [
        'client_id',
        'client_secret',
    ];
    /**
     * @throws ClientAdapterException
     */
    public function __construct(
        private readonly ClientInterface $client,
        private readonly array $options
    )
    {
       $this->handleRequiredParameters();
    }

    /**
     * Get base URI for discord API.
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->options["base_uri"] ?? "https://discordapp.com/api/v10";
    }

    /**
     * Handle options with self::REQUIRED_PARAMETERS
     *
     * @return void
     * @throws ClientAdapterException
     */
    private function handleRequiredParameters(): void
    {
        $emptyParameters = [];
        foreach (self::REQUIRED_PARAMETERS as $parameter) {
            if (
                array_key_exists($parameter, $this->options)
                && !empty($this->options[$parameter])
            ) {
                continue;
            }
            $emptyParameters[] = $parameter;
        }

        throw ClientAdapterException::missingRequiredParameter($emptyParameters);
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(RequestInterface $request, array|string $scope): ResponseInterface
    {
        return $this->client->sendRequest($request);
    }
}