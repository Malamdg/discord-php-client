<?php

declare(strict_types = 1);

namespace Malamdg\DiscordPhpClient\ClientAdapter;

use Malamdg\DiscordPhpClient\ClientAdapter\Exception\ClientAdapterException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ClientAdapterInterface
{
    /**
     * Basic function to send API request
     *
     * @param RequestInterface $request
     * @param array|string $scope
     *
     * @return ResponseInterface
     * @throws ClientAdapterException
     */
    public function sendRequest(RequestInterface $request, array|string $scope): ResponseInterface;
}