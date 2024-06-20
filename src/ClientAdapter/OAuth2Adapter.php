<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient\ClientAdapter;

use Berlioz\Http\Message\Factory\RequestFactoryTrait;
use DateInterval;
use DateTimeImmutable;
use Malamdg\DiscordPhpClient\AccessToken;
use Malamdg\DiscordPhpClient\ClientAdapter\Exception\OAuth2AdapterException;
use Malamdg\DiscordPhpClient\Exception\DiscordClientException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Throwable;

/**
 * @internal
 */
class OAuth2Adapter extends AbstractClientAdapter
{
    use RequestFactoryTrait;

    private array $accessTokens;
    public function __construct(
        private readonly ClientInterface $client,
        private readonly array           $options,
    )
    {
        parent::__construct($this->client, $this->options);
    }

    /**
     * Authenticate to app.
     *
     * @param array $scope
     *
     * @return AccessToken
     * @throws OAuth2AdapterException
     */
    public function authenticate(array $scope): AccessToken
    {
        try {
            $auth = base64_encode("{$this->options["client_id"]}:{$this->options["client_secret"]}");

            $response = $this->client->sendRequest(
                $this->createRequest(
                    'POST',
                    uri: $this->getBaseUri().'/oauth2/token',
                    headers: [
                        'Content-Type' => 'x-www-form-urlencoded',
                        'Authorization' => 'Basic '.$auth,
                    ],
                    body: [
                        "grant_type" => "client_credentials",
                        "scope" => implode(" ", $scope),
                    ]
                )
            );

            if ($response->getStatusCode() !== 200) {
                throw OAuth2AdapterException::authenticate();
            }

            $contents = json_decode(json: $response->getBody()->getContents(), associative: true, flags: JSON_THROW_ON_ERROR);

            return new AccessToken(
                token: $contents["access_token"],
                scope: $scope,
                expiration: (new DateTimeImmutable())->add(new DateInterval(sprintf('PT%dS', $contents['expires_in']))),
            );
        } catch (OAuth2AdapterException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw OAuth2AdapterException::authenticate($exception);
        }
    }

    /**
     * Get access token.
     *
     * @param array|string $scope
     *
     * @return AccessToken
     * @throws OAuth2AdapterException
     */
    public function getAccessToken(array|string $scope): AccessToken
    {
        is_string($scope) && $scope = array_filter(explode(' ', $scope));

        // Remove expired tokens
        $this->accessTokens = array_filter($this->accessTokens, fn (AccessToken $accessToken) => !$accessToken->isExpired());

        foreach ($this->accessTokens as $accessToken) {
            if ($accessToken->hasScope($scope)) {
                return $accessToken;
            }
        }

        return $this->accessTokens[] = $this->authenticate($scope);
    }


    /**
     * Send request.
     *
     * @param RequestInterface $request
     * @param array|string $scope
     *
     * @return ResponseInterface
     * @throws OAuth2AdapterException
     */
    public function sendRequest(RequestInterface $request, array|string $scope): ResponseInterface
    {
        try {
            $request = $request
                ->withUri($request->getUri(), $this->getBaseUri())
                ->withHeader('Authorization', 'Bearer ' . $this->getAccessToken($scope)->getToken());
            return $this->client->sendRequest($request);
        } catch (Throwable $e) {
            throw OAuth2AdapterException::sendRequest($e);
        }
    }
}