<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use Psr\Http\Client\ClientInterface;

class DiscordClient
{
    private HttpClientAdapter $httpClient;

    public function __construct(
        private readonly array $options,
        ClientInterface        $httpClient
    )
    {
        $this->setHttpClient($httpClient);
    }

    public function setHttpClient(ClientInterface $httpClient): void
    {
        $this->httpClient = new HttpClientAdapter($httpClient, $this->options);
    }
}