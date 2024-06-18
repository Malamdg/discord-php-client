<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use Berlioz\Http\Message\Factory\RequestFactoryTrait;
use DateInterval;
use DateTimeImmutable;
use Malamdg\DiscordPhpClient\Exception\DiscordClientException;
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

    private array $accessTokens;
    public function __construct(
        private readonly ClientInterface $client,
        private readonly array           $options,
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
     * @return AccessToken
     * @throws DiscordClientException
     */
    public function authenticate(): AccessToken
    {
        try {
            $response = $this->client->sendRequest(
                $this->createRequest(
                    'POST',
                    uri: $this->getBaseUri().'/oauth2/token',
                    headers: [
                        'Content-Type' => 'x-www-form-urlencoded',
                    ],
                    body: [
                        "client_id" => $this->options["client_id"],
                        "client_secret" => $this->options["client_secret"],
                        "grant_type" => "authorization_code",
                        "code" => $this->options["code"],
                        "redirect_uri" => $this->options["redirect_uri"],
                    ]
                )
            );

            if ($response->getStatusCode() !== 200) {
                throw DiscordClientException::authenticate();
            }

            $contents = json_decode(json: $response->getBody()->getContents(), associative: true, flags: JSON_THROW_ON_ERROR);

            return new AccessToken(
                token: $contents["access_token"],
                expiration: (new DateTimeImmutable())->add(new DateInterval(sprintf('PT%dS', $contents['expires_in']))),
            );
        } catch (DiscordClientException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw DiscordClientException::authenticate($exception);
        }
    }

    /**
     * Get access token.
     *
     * @return AccessToken
     * @throws DiscordClientException
     */
    public function getAccessToken(): AccessToken
    {
        // Remove expired tokens
        $this->accessTokens = array_filter($this->accessTokens, fn (AccessToken $accessToken) => !$accessToken->isExpired());

        if (count($this->accessTokens) !== 0) {
            return reset($this->accessTokens);
        }

        return $this->accessTokens[] = $this->authenticate();
    }


    /**
     * Send request.
     *
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     * @throws DiscordClientException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            $request = $request
                ->withUri($request->getUri(), $this->getBaseUri())
                ->withHeader('Authorization', 'Bearer ' . $this->getAccessToken()->getToken());
            return $this->client->sendRequest($request);
        } catch (Throwable $e) {
            throw DiscordClientException::sendRequest($e);
        }
    }
}