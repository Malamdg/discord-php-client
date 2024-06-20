<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use Malamdg\DiscordPhpClient\ClientAdapter\Factory\ClientAdapterFactory;
use Malamdg\DiscordPhpClient\ClientAdapter\ClientAdapterInterface;
use Malamdg\DiscordPhpClient\Exception\DiscordClientException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Throwable;

/**
 * Wrapper for Rest API request of discord API.
 */
class DiscordClient
{
    private ClientAdapterInterface $httpClient;

    /**
     * @throws DiscordClientException
     */
    public function __construct(
        private readonly array $options,
        ClientInterface        $httpClient
    )
    {
        $this->setHttpClient($httpClient);
    }

    /**
     * Set httpClient according to options.
     *
     * @param ClientInterface $httpClient
     *
     * @return void
     * @throws DiscordClientException
     */
    public function setHttpClient(ClientInterface $httpClient): void
    {
        try {
            $this->httpClient = ClientAdapterFactory::createClientAdapter($httpClient, $this->options);
        } catch (Throwable $e) {
            throw DiscordClientException::setupClientAdapter($e);
        }
    }

    /**
     * Send request through this httpClient.
     *
     * @param RequestInterface $request
     * @param array|string $scope
     *
     * @return Result
     * @throws DiscordClientException
     */
    public function sendRequest(RequestInterface $request, array|string $scope = []): Result
    {
        try {
            $response = $this->httpClient->sendRequest($request, $scope);

            return new Result($response);
        } catch (Throwable $e) {
            throw DiscordClientException::sendRequest($e);
        }
    }
}