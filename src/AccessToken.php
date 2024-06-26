<?php

declare(strict_types=1);

namespace Malamdg\DiscordPhpClient;

use DateTime;
use DateTimeImmutable;

/**
 * @internal
 */
readonly class AccessToken
{
    public function __construct(
        private string            $token,
        private array             $scope,
        private DateTimeImmutable $expiration,
    )
    {
    }

    /**
     * Get token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Get scope.
     *
     * @return array
     */
    public function getScope(): array
    {
        return $this->scope;
    }

    /**
     * Has scope?
     *
     * @param array|string $scope
     *
     * @return bool
     */
    public function hasScope(array|string $scope): bool
    {
        is_string($scope) && $scope = array_filter(explode(' ', $scope));

        return empty(array_diff($scope, $this->scope));
    }


    /**
     * Is access token expired ?
     *
     * @return bool
     */
    public function isExpired(): bool
    {
        return (new DateTime()) > $this->expiration;
    }
}
