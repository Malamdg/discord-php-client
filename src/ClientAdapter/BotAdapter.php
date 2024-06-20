<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient\ClientAdapter;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BotAdapter extends AbstractClientAdapter
{

    public function __construct(
        ClientInterface        $client,
        private readonly array $options
    )
    {
        parent::__construct($client, $options);
    }

    public function sendRequest(RequestInterface $request, array|string $scope = []): ResponseInterface
    {
        $token = $this->options['bot_token'];
        $request->withHeader("Authorization", "Bot $token");

        return parent::sendRequest($request, $scope);
    }
}